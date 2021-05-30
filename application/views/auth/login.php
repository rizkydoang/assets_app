<div class="container">

<!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-8 " style="margin-top:100px;">
            <div class="card o-hidden border-0 shadow-lg my-5 ">
                <div class="card-body ">
                    <!-- Nested Row within Card Body -->
                    <div class="row" style="margin:auto; padding: 10px; float:center;">
                        <div class="col-lg-12">  
                            <div class="">
                                <div class="text-center" style="margin-bottom: 34px;">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome To SAS Assets</h1>
                                </div>
                                <?= $this->session->flashdata('pesan'); ?>
                                <?= form_open('', ['class' => 'user']); ?>
                                <div class="form-group">
                                    <label for="username">Username* </label>
                                    <input type="text" class="form-control form-control-user"
                                        id="username" name="username" placeholder="Enter Username">
                                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group" style="margin-bottom: 34px;">
                                    <label for="username">Password* </label>
                                    <input type="password" class="form-control form-control-user"
                                        id="password" name="password" placeholder="Enter Password">
                                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>