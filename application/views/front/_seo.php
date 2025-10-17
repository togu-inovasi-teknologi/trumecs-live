<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-789013555">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-789013555');
</script>
<?php if($this->uri->segment(1) == 'trumecs-bazaar'): ?>
<!-- Event snippet for Website traffic conversion page
In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
<script>
function gtag_report_conversion(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-789013555/MnhuCMeE18QDELPInfgC',
      'value': 1000.0,
      'currency': 'IDR',
      'event_callback': callback
  });
  return false;
}
</script>

<?php endif; ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-70444204-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', 'UA-70444204-1', {
  'user_id': '<?php echo session_id() ?>'
});
</script>
<!-- Google Tag Manager -->
<script>
  (function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
      'gtm.start': new Date().getTime(),
      event: 'gtm.js'
    });
    var f = d.getElementsByTagName(s)[0],
      j = d.createElement(s),
      dl = l != 'dataLayer' ? '&l=' + l : '';
    j.async = true;
    j.src =
      'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
    f.parentNode.insertBefore(j, f);
  })(window, document, 'script', 'dataLayer', 'GTM-TVC4G9C');
</script>
<!-- End Google Tag Manager -->
<title><?php echo (isset($seotitle)) ? $seotitle : "Trumecs.com: Solusi kebutuhan pelumas, sparepart truk & alat berat"; ?></title>
<meta name="alexaVerifyID" content="ts_cnyBhrmMvxSPnmtTdwDbRLBM" />
<meta name="google-site-verification" content="DPQIhtWS0YWJJt2rkO2sV2Mc0HPyqXsOWpllESACy-o" />
<meta name="msvalidate.01" content="172A51B00E52BB87B9CA301E14F4C30E" />
<!-- for Google -->
<meta name="keywords" content="<?php echo (isset($seokeywords)) ? $seokeywords : "Sparepart"; ?>" />
<meta name="copyright" content="PT Tiyasa Makmur Perkasa" />
<meta name="application-name" content="Trumecs" />
<meta name="title" content="<?php echo (isset($seotitle)) ? $seotitle : "Trumecs.com: Solusi kebutuhan pelumas, sparepart truk & alat berat"; ?>" />
<meta name="description" content="<?php echo (isset($seodescription)) ? $seodescription : "Trumecs.com menyediakan berbagai jenis pelumas & sparepart truk & alat berat yang digunakan di seluruh Indonesia"; ?>">
<meta name="author" content="PT Tiyasa Makmur Perkasa">
<link href="https://plus.google.com/+TrumecsTrisindo" rel="publisher">
<!-- for Facebook -->
<meta property="og:title" content="<?php echo (isset($seotitle)) ? $seotitle : "Trumecs.com: Solusi kebutuhan pelumas, sparepart truk & alat berat"; ?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php echo (isset($seoimage)) ? base_url() . $seoimage : base_url() . "public/image/logonew.png"; ?>" />
<meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" />
<meta property="og:description" content="<?php echo (isset($seodescription)) ? $seodescription : "Trumecs.com menyediakan berbagai jenis pelumas & sparepart truk & alat berat yang digunakan di seluruh Indonesia"; ?>" />
<!-- for Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?php echo (isset($seotitle)) ? $seotitle : "Trumecs.com: Solusi kebutuhan pelumas, sparepart truk & alat berat"; ?>" />
<meta name="twitter:description" content="<?php echo (isset($seodescription)) ? $seodescription : "Trumecs.com menyediakan berbagai jenis pelumas & sparepart truk & alat berat yang digunakan di seluruh Indonesia"; ?>" />
<meta name="twitter:image" content="<?php echo (isset($seoimage)) ? base_url() . $seoimage : base_url() . "public/image/logonew.png"; ?>" />

<script src="https://apis.google.com/js/platform.js" async defer></script>
<link rel="canonical" href="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" />

<meta name="dc.date" content="2016-02-08">
<meta name="dc.date" scheme="ISO8601" content="2016-02-08T18:00:15+00:00">
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "Trumecs",
    "alternateName": "trumecs.com",
    "url": "https://www.trumecs.com",
    "potentialAction": {
      "@type": "SearchAction",
      "target": "https://www.trumecs.com/c/query?q=on&nama={nama}",
      "query-input": "required name=nama"
    }
  }
</script>
<!-- Meta Pixel Code -->
<script>
  ! function(f, b, e, v, n, t, s) {
    if (f.fbq) return;
    n = f.fbq = function() {
      n.callMethod ?
        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
    };
    if (!f._fbq) f._fbq = n;
    n.push = n;
    n.loaded = !0;
    n.version = '2.0';
    n.queue = [];
    t = b.createElement(e);
    t.async = !0;
    t.src = v;
    s = b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t, s)
  }(window, document, 'script',
    'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '1933618450156859');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1933618450156859&ev=PageView&noscript=1" /></noscript>
<!-- End Meta Pixel Code -->