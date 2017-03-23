<div class="container">
    <h1 class="text-center">Login</h1>

    <hr>

    <div class="panel panel-default">
        <div class="panel-body">
            <form action="/login" method="POST" class="form-horizontal" role="form">
                
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="name" class="form-control" value="" required="required" title="">
                    </div>
                </div>

                <div class="form-group">
                    <label for="pass" class="col-sm-2 control-label">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" name="pass" id="pass" class="form-control" value="" required="required" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    

</div>
