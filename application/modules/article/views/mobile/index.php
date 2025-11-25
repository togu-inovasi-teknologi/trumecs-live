<div class="container">
    <div class="row my-3">
        <div class="col-12">
            <div class="row g-2">
                <?php for ($i = 0; $i < 5; $i++) : ?>
                    <?php if (isset($data_page_main[$i])) : ?>
                        <div class="col-12 mb-2">
                            <a href="<?php echo base_url() ?>article/<?php echo $data_page_main[$i]['url'] ?>" class="text-decoration-none d-block">
                                <?php echo $this->load->view('desktop/_main_article_small', ['article' => $data_page_main[$i], 'img_base_url' => 'http://trumecs.com/']) ?>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>
<section class="tabsearch" id="tabsearch">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6 class="fbold">Kirim Permintaan Barang Di Trumecs Lebih Mudah dan Cepat</h6>
            </div>
            <div class="col-lg-12">
                <div class="card p-a-1">
                    <?php $this->load->view('tab/mobile/tabs') ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container my-4">
    <div class="row trend-article" id="trend-article">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body d-flex flex-column gap-3 p-3" id="article-list">
                    <div class="col-12">
                        <h5 class="fw-bold mb-0"><?= $this->lang->line('label_trending'); ?></h5>
                    </div>
                    <?php foreach ($dataTrendingNews as $article) : ?>
                        <a href="<?php echo base_url() ?>article/<?php echo $article['url'] ?>"
                            class="text-decoration-none text-dark">
                            <?= $this->load->view('mobile/_article_row_small', ['artikel' => $article, 'img_base_url' => 'http://trumecs.com/']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="article-content my-4" id="article-content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column gap-3" id="article-list">
                    <?php foreach ($data_page as $artikel) : ?>
                        <a href="<?php echo base_url() ?>article/<?php echo $artikel['url'] ?>"
                            class="text-decoration-none text-dark">
                            <?= $this->load->view('mobile/_article_row_small', ['artikel' => $artikel]) ?>
                        </a>
                    <?php endforeach ?>
                </div>
                <div class="row my-4">
                    <div class="col-12 text-center">
                        <?php echo $links ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .hr-dashed {
        border-top: 2px dashed white;
    }

    .label-article {
        font-size: 16px !important;
        color: black;
        background-color: #fff;
        padding: 10px;
        border-width: 0.2px;
        border-style: solid;
        border-color: grey;
        border-radius: 10px;
    }

    .news-container {
        background-color: #fff;
        top: 0;
        left: 0;
        right: 0;
        font-family: "Poppins", sans-serif;
        box-shadow: 0 4px 8px -4px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        border: 0.5px solid #ccc;
    }

    .news-container ul {
        display: flex;
        list-style: none;
        margin: 0;
        animation: scroll 25s infinite linear;
    }

    .news-container ul li {
        white-space: nowrap;
        padding: 10px 24px;
        color: #494949;
        position: relative;
    }

    .news-container ul li::after {
        content: "";
        width: 1px;
        height: 100%;
        background: #b8b8b8;
        position: absolute;
        top: 0;
        right: 0;
    }

    .news-container ul li:last-child::after {
        display: none;
    }

    @keyframes scroll {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(-120%);

        }
    }
</style>