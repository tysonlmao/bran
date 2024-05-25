<?php
include($_SERVER['DOCUMENT_ROOT'] . '/assets/templates/header.php');
if(!isset($_SESSION['cuid'])):
    header("Location: ../login");
endif;
if (isset($_SESSION['cuid'])) :
    if($_SESSION['cuid_role'] !== 'admin'): // Modified this line
        header("Location: ../dashboard");
    endif;
endif;

include $base_dir . 'inc/connect.inc.php';
$query = "SELECT u.*, ud.bran_daily, ud.bran_total FROM users u JOIN user_data ud ON u.id = ud.user_id ORDER BY bran_total DESC LIMIT 8";
$stmt = $pdo->query($query);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<body>
<script src="../assets/js/greetings.js"></script>
<div class="row">
    <div class="col-md-2">
        <div class="window text-center">
            <div class="d-flex justify-content-center align-items-center">
                <img src="../assets/img/bran.png" alt="bran" class="logo-sm">
            </div>
            <ul class="nav nav-tabs flex-column">
                <li class="nav-item">
                    <a class="nav-link active show" data-bs-toggle="tab" href="#dash">dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#settings">settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#moderation">moderation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#logging">logging</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-10">
        <div class="window">
            <div class="tab-content">
                <div class="tab-pane active" id="dash">
                    <h3 class="navbar-brand" id="greeting"><?php echo $_SESSION['cuid_username'] ?></h3>
                </div>
                <div class="tab-pane" id="settings">
                    <p class="modal-title fs-5">general</p>
                </div>
                <div class="tab-pane" id="moderation">
                    <p class="modal-title fs-5">moderation</p>
                    <div> 
                    <table class="table table-dark table-bordered">
                        <thead>
                            <tr>
                            <th>username</th>
                            <th>role</th>
                            <th>bran total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $result): ?>
                            <tr>
                                <td><?php echo $result['username'] ?></td>
                                <td><?php echo $result['role'] ?></td>
                                <td><?php echo $result['bran_total'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="tab-pane" id="logging">
                    <p class="modal-title fs-5">logging</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>