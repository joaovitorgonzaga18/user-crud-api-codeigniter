<!DOCTYPE html>
<html data-mdb-theme="dark">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="/assets/mdb/css/mdb.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/assets/mdb/js/mdb.min.js"></script>
    <script src="/assets/js/jquery-3.7.1.js"></script>
    <script src="/assets/js/loadingoverlay.min.js"></script>
</head>

<body>
    <div class="container-fluid vh-100 ">
        <div class="row">
            <div class="col-md-4">
                <button type="button" class="btn btn-Danger" onclick="logout()"><i class="fa-solid fa-door-open"></i> Logout</button>
            </div>
        </div>
        <div class="row" style="padding: 2.5em" id="div-list">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="">New User</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="" id="form-new-user">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Ex.: John Doe" value="" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Ex.: email@email.com" value="" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Choose a strong password" value="" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="access_level">Access Level</label>
                                    <select class="form-select" aria-label="Default select example" id="access_level" name="access_level" required>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="">Update User</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="" id="form-update-user">
                            <input type="hidden" id="user_id" name="user_id" value="0">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="" required disabled>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" value="" required disabled>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="" required disabled>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="access_level">Access Level</label>
                                    <select class="form-select" aria-label="Default select example" id="access_level" name="access_level" required disabled>
                                        <option value="0"></option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" disabled>Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary d-none text-center" role="alert" id="message-alert">

                </div>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Access Level</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <th scope="row"><?= esc($user['id']) ?></th>
                                <td><?= esc($user['name']) ?></td>
                                <td><?= esc($user['email']) ?></td>
                                <td><?= esc($user['access_level']) ?></td>
                                <td><?= esc($user['created_at']) ?></td>
                                <td><?= esc($user['updated_at']) ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" onclick="loadUser(<?= esc($user['id']) ?>)"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button type="button" class="btn btn-danger" onclick="deleteUser(<?= esc($user['id']) ?>)"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No users found.</p>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

<script src="/assets/js/main.js"></script>

</html>