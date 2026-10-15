/**
 * Konversi gambar sumber (PNG/JPG) -> WebP sekali jalan.
 *
 * Hasilnya bisa di-upload ke trumecs.com supaya:
 *  - server tidak perlu re-encode tiap request (hemat CPU)
 *  - first load jauh lebih cepat di mobile
 *
 * Folder yang diproses:
 *  - public/tag/industries   (kartu industri, LCP di mobile)
 *  - public/banner/promo-home, home-mobile, category
 *
 * Output: mirror folder + suffix "-mobile" untuk varian mobile.
 *
 * Jalankan:  node scripts/convert-images-to-webp.js
 */

const fs = require("fs");
const path = require("path");
// sharp diambil dari node_modules trunuxt (sudah ter-install di sana)
const sharp = require("D:/Program/laragon/www/trunuxt/node_modules/sharp");

const ROOT = "D:/Program/laragon/www/trumecs-live";
const SRC_BASE = path.join(ROOT, "public");
const OUT_BASE = path.join(ROOT, "..", "webp-output");

const TARGET_DIRS = [
  "tag/industries",
  "banner/promo-home",
  "banner/home-mobile",
  "banner/category",
];

const QUALITY = 80;
const MOBILE_WIDTH = 800;

const KB = (bytes) => `${(bytes / 1024).toFixed(0)} KB`;

function human(n) {
  return n >= 1024 * 1024 ? `${(n / 1024 / 1024).toFixed(1)} MB` : KB(n);
}

async function convertFile(srcPath, outDir, name, { mobile = false } = {}) {
  const base = fs.statSync(srcPath).size;
  const pipeline = sharp(srcPath).rotate();

  let outName;
  let target;

  if (mobile) {
    const meta = await sharp(srcPath).metadata();
    // Jangan diperbesar
    const width = Math.min(MOBILE_WIDTH, meta.width || MOBILE_WIDTH);
    target = await pipeline
      .resize({ width, withoutEnlargement: true })
      .webp({ quality: QUALITY })
      .toBuffer();
    outName = `${name}-mobile.webp`;
  } else {
    target = await pipeline.webp({ quality: QUALITY }).toBuffer();
    outName = `${name}.webp`;
  }

  const outPath = path.join(outDir, outName);
  fs.writeFileSync(outPath, target);

  return { src: base, out: target.length, outName, saved: base - target.length };
}

async function processDir(relDir) {
  const srcDir = path.join(SRC_BASE, relDir);
  if (!fs.existsSync(srcDir)) {
    console.log(`SKIP  ${relDir} (tidak ada)`);
    return { files: 0, before: 0, after: 0 };
  }

  const outDir = path.join(OUT_BASE, relDir);
  fs.mkdirSync(outDir, { recursive: true });

  const entries = fs
    .readdirSync(srcDir)
    .filter((f) => /\.(png|jpe?g)$/i.test(f));

  let before = 0;
  let after = 0;
  let count = 0;

  for (const file of entries) {
    const srcPath = path.join(srcDir, file);
    if (!fs.statSync(srcPath).isFile()) continue;

    const name = path.basename(file, path.extname(file));
    try {
      const meta = await sharp(srcPath).metadata();
      const r1 = await convertFile(srcPath, outDir, name);

      // Varian mobile hanya jika gambar lebar enough
      let r2 = null;
      if ((meta.width || 0) > MOBILE_WIDTH) {
        r2 = await convertFile(srcPath, outDir, name, { mobile: true });
      }

      before += r1.src + (r2 ? r2.src : 0);
      after += r1.out + (r2 ? r2.out : 0);
      count += 1;

      const lines = [
        `  ${name}: ${human(r1.src)} -> ${KB(r1.out)} (${r1.outName})`,
      ];
      if (r2) {
        lines.push(
          `      mobile: ${human(r2.src)} -> ${KB(r2.out)} (${r2.outName})`
        );
      }
      console.log(lines.join("\n"));
    } catch (err) {
      console.log(`  GAGAL ${file}: ${err.message}`);
    }
  }

  console.log(
    `\n[${relDir}] ${count} file | ${human(before)} -> ${human(after)} ` +
      `(hemat ${human(before - after)})\n`
  );

  return { files: count, before, after };
}

(async () => {
  console.log(`Sumber : ${SRC_BASE}`);
  console.log(`Output : ${OUT_BASE}\n`);

  const totals = { files: 0, before: 0, after: 0 };

  for (const dir of TARGET_DIRS) {
    const r = await processDir(dir);
    totals.files += r.files;
    totals.before += r.before;
    totals.after += r.after;
  }

  const pct =
    totals.before > 0
      ? Math.round((1 - totals.after / totals.before) * 100)
      : 0;

  console.log("=".repeat(56));
  console.log(`TOTAL  ${totals.files} file`);
  console.log(`       ${human(totals.before)} -> ${human(totals.after)}`);
  console.log(`       hemat ${pct}% (${human(totals.before - totals.after)})`);
  console.log("=".repeat(56));
})();
