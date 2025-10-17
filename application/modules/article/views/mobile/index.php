<!--<div class="news-container">
    <ul>
        <li>
            Nikel <span style="color: green;">3.200</span> <i class="fa fa-caret-up" style="color: green;"></i>
        </li>
        <li>
            Batu Bara <span style="color: red;">23.200</span> <i class="fa fa-caret-down" style="color:red;"></i>
        </li>
        <li>
            seng <span style="color: green;">34.200</span> <i class="fa fa-caret-up" style="color: green;"></i>
        </li>
        <li>
            Batu Bara <span style="color: red;">23.200</span> <i class="fa fa-caret-down" style="color:red;"></i>
        </li>
        <li>
            seng <span style="color: green;">34.200</span> <i class="fa fa-caret-up" style="color: green;"></i>
        </li>
        <li>
            Batu Bara <span style="color: red;">23.200</span> <i class="fa fa-caret-down" style="color:red;"></i>
        </li>
        <li>
            seng <span style="color: green;">34.200</span> <i class="fa fa-caret-up" style="color: green;"></i>
        </li>
        <li>
            Batu Bara <span style="color: red;">23.200</span> <i class="fa fa-caret-down" style="color:red;"></i>
        </li>
        <li>
            seng <span style="color: green;">34.200</span> <i class="fa fa-caret-up" style="color: green;"></i>
        </li>
    </ul>
</div>-->
<div class="container">
    <div class="row d-flex m-y-2">
        <div class="col-xs-12">
            <div class="row img-grid">
                <div class="col-xs-12 m-b-1">
                    <a href="<?php echo base_url() ?>article/<?php echo $data_page_main[0]['url'] ?>"><?php echo $this->load->view('desktop/_main_article_small', ['article' => $data_page_main[0], 'img_base_url' => 'http://trumecs.com/']) ?></a>
                </div>
                <div class="col-xs-12 m-b-1">
                    <a href="<?php echo base_url() ?>article/<?php echo $data_page_main[1]['url'] ?>"><?php echo $this->load->view('desktop/_main_article_small', ['article' => $data_page_main[1], 'img_base_url' => 'http://trumecs.com/']) ?></a>
                </div>
                <div class="col-xs-12 m-b-1">
                    <a href="<?php echo base_url() ?>article/<?php echo $data_page_main[2]['url'] ?>"><?php echo $this->load->view('desktop/_main_article_small', ['article' => $data_page_main[2], 'img_base_url' => 'http://trumecs.com/']) ?></a>
                </div>
                <div class="col-xs-12 m-b-1">
                    <a href="<?php echo base_url() ?>article/<?php echo $data_page_main[3]['url'] ?>"><?php echo $this->load->view('desktop/_main_article_small', ['article' => $data_page_main[3], 'img_base_url' => 'http://trumecs.com/']) ?></a>
                </div>
                <div class="col-xs-12 m-b-1">
                    <a href="<?php echo base_url() ?>article/<?php echo $data_page_main[4]['url'] ?>"><?php echo $this->load->view('desktop/_main_article_small', ['article' => $data_page_main[4], 'img_base_url' => 'http://trumecs.com/']) ?></a>
                </div>

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
<div class="container m-y-lg">
    <div class="row trend-article" id="trend-article">
        <div class="col-xs-12">
            <div class="card">
                <div class="row d-flex flex-column gap-3 p-a-1" id="article-list">
                    <div class="col-xs-12">
                        <p class="f20 fbold"><?= $this->lang->line('label_trending'); ?></p>
                    </div>
                    <?php foreach($dataTrendingNews as $article) : ?>
                    <a href="<?php echo base_url() ?>article/<?php echo $article['url'] ?>"
                        class="color-black"><?= $this->load->view('mobile/_article_row_small', ['artikel' => $article, 'img_base_url' => 'http://trumecs.com/']) ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="article-content m-y-lg" id="article-content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row d-flex flex-column gap-2" id="article-list">
                    <?php foreach($data_page as $artikel) : ?>

                    <a href="<?php echo base_url() ?>article/<?php echo $artikel['url'] ?>"
                        class="color-black"><?= $this->load->view('mobile/_article_row_small', ['artikel' => $artikel]) ?></a>
                    <?php endforeach ?>
                </div>
                <div class="row m-y-lg">
                    <div class="col-lg-12 text-center">
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