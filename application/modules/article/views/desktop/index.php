<div class="container">
    <div class="row align-items-stretch my-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="featured-article h-100">
                <a href="<?php echo base_url() ?>article/<?php echo $data_page_main[0]['url'] ?>" class="text-decoration-none h-100 d-block">
                    <?php echo $this->load->view('desktop/_main_article_large', ['article' => $data_page_main[0], 'img_base_url' => 'http://trumecs.com/']) ?>
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row g-3 h-100">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <?php if (isset($data_page_main[$i])): ?>
                        <div class="col-lg-6 featured-article">
                            <a href="<?php echo base_url() ?>article/<?php echo $data_page_main[$i]['url'] ?>" class="text-decoration-none h-100 d-block">
                                <?php echo $this->load->view('desktop/_main_article_small', ['article' => $data_page_main[$i], 'img_base_url' => 'http://trumecs.com/']) ?>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>

<section class="tabsearch py-5 bg-light" id="tabsearch">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center mb-4">
                <h4 class="fw-bold mb-3">Kirim Permintaan Barang Lebih Mudah dan Cepat</h4>
                <p class="text-muted fs-5">Dengan <a href="/" class="text-warning">Trumecs</a>, proses pengadaan barang menjadi lebih efisien</p>
            </div>
            <div class="col-lg-12">
                <div class="card border-0 shadow-lg p-4">
                    <?php $this->load->view('tab/desktop/tabs') ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="article-content py-5" id="article-content">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <h3 class="fw-bold mb-0">Artikel Terbaru</h3>
                </div>

                <div class="row g-4" id="article-list">
                    <?php foreach ($data_page as $artikel) : ?>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm article-card">
                                <a href="<?php echo base_url() ?>article/<?php echo $artikel['url'] ?>" class="text-decoration-none text-dark">
                                    <?= $this->load->view('_article_row', ['artikel' => $artikel, 'img_base_url' => 'http://trumecs.com/']) ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>

                <!-- Pagination Section -->
                <div class="row py-5">
                    <div class="col-lg-12 text-center">
                        <div class="pagination-container">
                            <?php echo $links ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sticky-top" style="top: 10px;">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="card border-0 shadow-lg">
                                <div class="card-header bg-primary text-white py-3">
                                    <h5 class="fw-bold mb-0">
                                        <i class="fas fa-fire me-2"></i>
                                        <?= $this->lang->line('label_trending'); ?>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <?php foreach ($dataTrendingNews as $article) : ?>
                                            <div class="col-12">
                                                <div class="trending-item">
                                                    <a href="<?php echo base_url() ?>article/<?php echo $article['url'] ?>" class="text-decoration-none text-dark">
                                                        <?= $this->load->view('_article_row_small', ['artikel' => $article, 'img_base_url' => 'http://trumecs.com/']) ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .transition-all {
        transition: all 0.3s ease;
    }

    .transition-all:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .article-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .article-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1) !important;
        border-color: var(--bs-primary);
    }

    .trending-item {
        transition: all 0.2s ease;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding-bottom: 1rem;
    }

    .trending-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .trending-item:hover {
        transform: translateX(5px);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--bs-primary) 0%, #0056b3 100%);
    }

    .featured-article .card {
        transition: all 0.3s ease;
    }

    .featured-article .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
    }

    .pagination-container .pagination {
        justify-content: center;
    }

    .pagination-container .page-link {
        border-radius: 0.5rem;
        margin: 0 0.25rem;
        border: 1px solid var(--bs-gray-300);
    }

    .pagination-container .page-item.active .page-link {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }

    /* Existing styles dengan improvement */
    .hr-dashed {
        border-top: 2px dashed var(--bs-gray-300);
    }

    .label-article {
        font-size: 0.875rem !important;
        color: var(--bs-dark);
        background-color: var(--bs-white);
        padding: 0.5rem 1rem;
        border: 1px solid var(--bs-gray-300);
        border-radius: 2rem;
        font-weight: 500;
    }

    .news-container {
        background-color: var(--bs-white);
        font-family: "Poppins", sans-serif;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border-radius: 1rem;
        border: 1px solid var(--bs-gray-200);
    }

    .news-container ul {
        display: flex;
        list-style: none;
        margin: 0;
        animation: scroll 25s infinite linear;
    }

    .news-container ul li {
        white-space: nowrap;
        padding: 1rem 2rem;
        color: var(--bs-gray-700);
        position: relative;
        font-weight: 500;
    }

    .news-container ul li::after {
        content: "";
        width: 1px;
        height: 60%;
        background: var(--bs-gray-300);
        position: absolute;
        top: 20%;
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

    .text-gray {
        color: var(--bs-gray-600) !important;
    }

    .border-gray {
        border-color: var(--bs-gray-300) !important;
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .display-6 {
            font-size: 1.75rem;
        }

        .sticky-top {
            position: relative !important;
            top: 0 !important;
        }
    }

    .pagination {
        margin-bottom: 0;
    }

    .page-link {
        border-radius: 0.375rem;
        margin: 0 0.125rem;
        border: 1px solid #dee2e6;
        color: #495057;
        padding: 0.5rem 0.75rem;
    }

    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .page-link:hover {
        background-color: #e9ecef;
        border-color: #dee2e6;
        color: #495057;
    }

    .article-card {
        transition: all 0.3s ease;
    }

    .article-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
    }
</style>