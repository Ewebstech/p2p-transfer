<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;</button>
                <h4 class="modal-title" id="myModalLabel">Blossom Pay</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 extra-w3layouts" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                       
                            <li class="active"><a href="#Registration" data-toggle="tab">Register</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                      
                            <div class="tab-pane active" id="Registration">
                                
                                <form id="registration" class="form-horizontal" action="#" method="get">
                                    {{csrf_field()}}

                                <div class="row">
                                    <div id="reg-msg" style="font-size: 10px !important; margin-bottom: 20px;"></div>
                                </div>

                                <div class="form-group">
                                    
                                    <label for="email" class="col-sm-2 control-label">
                                        Full Name</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-md-9 col-sm-9 col-xs-9">
                                                <input type="text" class="form-control" placeholder="Name" name="fullname" required="required" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">
                                        Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mobile" class="col-sm-2 control-label">
                                        Mobile</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="phonenumber" placeholder="Mobile" name="phonenumber" required="required" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-2 control-label">
                                        Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required="required" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="submit btn btn-secondary btn-sm">
                                            <i class="fa fa-user"></i> Sign Me Up</button>
                                        <button type="reset" class="submit btn btn-default btn-sm">
                                            Cancel</button>
                                    </div>
                                </div>
                                
                                </form>
                            </div>
                        </div>
                        <div id="OR" >
                            OR</div>
                    </div>
                    <div class="col-md-4 extra-agileits">submit
                        <div class="row text-center sign-with">

                            <div class="col-md-12">
                                <h3 class="other-nw">
                                    Already have an account?</h3>
                            </div>

                            <div class="col-sm-12">
                                <a class="btn btn-primary btn-lg btn-rnd" href="./login">
                                   <i class="fa fa-sign-in"></i> Click Here to Log In</a>
                                
                            </div>

                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script src="/js/ajax.js"></script> --}}

<script>
    $('#myModal').modal('show');
</script>
{{-- 
<script>
    $("#registration").submit(function (e) {
        e.preventDefault();
        submit_form_no_reload('registration', "{{ route('signup') }}", 'reg-msg', true);
    });
</script> --}}