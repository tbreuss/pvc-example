<?php /** @var \Throwable $error */ ?>
<div class="container">
    <h2>Error 500</h2>
    <p><?= $error->getMessage() ?></p>
    <pre><?= $error->getTraceAsString() ?></pre>
</div>