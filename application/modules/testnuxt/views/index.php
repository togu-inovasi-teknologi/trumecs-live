<!DOCTYPE html>
<html>

<head>
    <title>CI3 Proxy to Nuxt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f0f0f0;
        }

        .header {
            background: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .nav {
            background: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .nav a {
            margin-right: 15px;
            padding: 10px 15px;
            background: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }

        .iframe-container {
            background: white;
            padding: 10px;
            border-radius: 5px;
        }

        iframe {
            width: 100%;
            height: 500px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>🚀 CI3 Proxy to Nuxt.js</h1>
        <p>Current Page: <?php echo $current_page; ?> | CI3 Port: 8000 | Nuxt Port: 3000</p>
    </div>

    <div class="nav">
        <a href="<?php echo base_url('testnuxt'); ?>">Test Page</a>
        <a href="<?php echo base_url('testnuxt/dashboard'); ?>">Dashboard</a>
        <a href="<?php echo base_url('testnuxt/profile'); ?>">Profile</a>
        <a href="<?php echo $ci3_base_url; ?>">Back to CI3 Home</a>
    </div>

    <div class="iframe-container">
        <h3>Nuxt Content (from port 3000):</h3>
        <iframe src="<?php echo $nuxt_url; ?>"></iframe>
    </div>

    <div class="info">
        <p><strong>Browser URL:</strong> http://localhost:8000/testnuxt/<?php echo $current_page; ?></p>
        <p><strong>Actual Content:</strong> <?php echo $nuxt_url; ?></p>
        <p><strong>Status:</strong> CI3 acting as proxy gateway</p>
    </div>
</body>

</html>