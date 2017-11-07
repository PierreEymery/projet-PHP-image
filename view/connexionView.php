<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="fr" >
    <head>
        <title>Site SIL3</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="view/style.css" media="screen" title="Normal" />
        <link rel="stylesheet" type="text/css" href="view/bootstrap/css/bootstrap.min.css"/>
    </head>
    <body class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <form method="post" action="index.php?controller=membre">

                    <legend>Connexion</legend>

                    <div class="form-group">
                        <label class="col-md-6 control-label">Login</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="login" placeholder="Login" required>
                        </div>
                        <br></br>
                        <div class="form-group">
                            <label class="col-md-6 control-label">Mot de passe</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                            </div>
                        </div>
                        <br/><br/>
                        <center><button type="submit" name="connexion" class="btn btn-primary">Connexion</button></center>
                        <br/><br/>
                </form>
            </div>
            <div class="col-lg-3"></div>
            <div class="col-lg-12">
                <center><label class="col-md-12 control-label" onclick="cache('aCacher')" style="cursor:pointer;">Vous n'êtes pas encore inscrit, n'attendez plus</label></center>
            </div>

            <div id="aCacher" class="col-lg-12" style="display: none;">
                <form method="post" action="index.php?controller=membre">
                    <legend>S'inscrire sur le site</legend>
                    <div class="form-group">
                        <label class="col-md-6 control-label">Login</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="login" placeholder="Login" required>
                        </div>
                    </div><br/>
                    <div class="form-group">
                        <label class="col-md-6 control-label">Mot de passe</label>
                        <div class="col-md-10">
                            <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                        </div>
                    </div>
                    <br/><br/><center><button type="submit" name="inscription" class="btn btn-primary">S'Inscrire</button></center>
                </form>
            </div>
        </div>
    </body>
    <script>
        var bool = false;
        function cache(id) {
            if (bool === true) {
                document.getElementById(id).style.display = 'none';
                bool = false;
            } else {
                document.getElementById(id).style.display = 'block';
                bool = true;
            }
        }
    </script>
</html>
