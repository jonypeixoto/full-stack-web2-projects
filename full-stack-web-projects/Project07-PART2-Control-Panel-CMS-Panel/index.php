<?php
  $pdo = new PDO('mysql:host=localhost;dbname=bootstrap_cms_project07','root','');
  $about = $pdo->prepare("SELECT * FROM `tb_about`");
  $about->execute();
  $about = $about->fetch()['about'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control Panel - CMS Panel</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>

  <nav class="navbar navbar-fixed-top navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">CybertimeUP</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul id="main-menu" class="nav navbar-nav">
            <li class="active"><a ref_sys="about" href="#">Edit About</a></li>
            <li><a ref_sys="register_team" href="#">Register Team</a></li>
            <li><a ref_sys="team_list" href="#">Team List</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="?leaveout"><span class="glyphicon glyphicon-off"></span> Leave out!</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  
    <div style="position: relative;top: 50px;" class="box">

    <header id="header">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <h2>Control Panel <span class="glyphicon glyphicon-cog" aria-hidden="true"></span></h2>
          </div><!--col-md-9-->
          <div class="col-md-3">
            <p><span class="glyphicon glyphicon-time"></span> Your last login was on: 13/09/21</p>
          </div><!--col-md-3-->
        </div><!--row-->
      </div><!--container-->
    </header><!--header-->

    <section class="bread">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Home</li>
        </ol>
      </div><!--bread-->
    </section>

    <section class="principal">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item active standard-color" ref_sys="about"><span class="glyphicon glyphicon-pencil"></span> About</a>
                <a href="#" class="list-group-item" ref_sys="register_team"><span class="glyphicon glyphicon-pencil"></span> Register Team</a>
                <a href="#" class="list-group-item" ref_sys="team_list"><span class="glyphicon glyphicon-list-alt"></span> Team List <span class="badge">2</span></a>
            </div><!--list-group-->
          </div><!--col-md-3-->

          <div class="col-md-9">
          <?php
            if(isset($_POST['edit_about'])){
              $about = $_POST['about'];
              $pdo->exec("DELETE FROM `tb_about`");
              $sql = $pdo->prepare("INSERT INTO `tb_about` VALUES (null,?)");
              $sql->execute(array($about));
              echo '<div class="alert alert-success" role="alert">The HTML code <b>About</b> has been edited successfully!</div>';
              $about = $pdo->prepare("SELECT * FROM `tb_about`");
              $about->execute();
              $about = $about->fetch()['about'];
            }else if(isset($_POST['register_team'])){
              $name = $_POST['name_member'];
              $description = $_POST['description'];
              $sql = $pdo->prepare("INSERT INTO `tb_team` VALUES (null,?,?)");
              $sql->execute(array($name,$description));
              echo '<div class="alert alert-success" role="alert">The team member had been registered success!</div>';
            }
          ?>
              <div id="about_section" class="panel panel-default">
                  <div class="panel-heading standard-color">
                    <h3 class="panel-title">About</h3>
                  </div><!--panel-heading standard-color-->
                  <div class="panel-body">
                  <form method="post">
                    <div class="form-group">
                      <label for="email">HTML Code:</label>
                      <textarea name="about" style="height: 140px;resize: vertical;" class="form-control"><?php echo $about; ?></textarea>
                    </div><!--form-group-->
                    <input type="hidden" name="edit_about" value="">
                    <button type="submit" name="action" class="btn btn-default">Submit</button>
                </form>
                  </div><!--panel-body-->
              </div><!--panel-panel-default-->

              <div id="register_team_section" class="panel panel-default">
                  <div class="panel-heading standard-color">
                    <h3 class="panel-title">Register Team</h3>
                  </div><!--panel-heading standard-color-->
                  <div class="panel-body">
                  <form method="post">
                    <div class="form-group">
                      <label for="email">Team member name:</label>
                      <input type="text" name="name_member" class="form-control" />
                    </div><!--form-group-->
                    <div class="form-group">
                      <label for="email">Member description:</label>
                      <textarea name="description" style="height: 140px;resize: vertical;" class="form-control"></textarea>
                    </div><!--form-group-->
                    <input type="hidden" name="register_team" />
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                  </div><!--panel-body-->
              </div><!--panel-panel-default-->

              <div id="team_list_section" class="panel panel-default">
                  <div class="panel-heading standard-color">
                    <h3 class="panel-title">Team List</h3>
                  </div><!--panel-heading standard-color-->
                  <div class="panel-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>ID:</th>
                          <th>Member name</th>
                          <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $selectMembers = $pdo->prepare("SELECT `id`,`name` FROM `tb_team`");
                          $selectMembers->execute();
                          $members = $selectMembers->fetchAll();
                          foreach($members as $key=>$value){                                     
                        ?>
                        <tr>
                          <td><?php echo $value['id']; ?></td>
                          <td><?php echo $value['name']  ?></td>
                          <td><button id_member="<?php echo $value['id']; ?>" type="button" class="delete-member btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button></td>
                        </tr>

                        <?php } ?>
                        
                      </tbody>
                    </table>
                  </div><!--panel-body-->
              </div><!--panel-panel-default-->
          </div><!--col-md-9-->
        </div><!--row-->
      </div><!--container-->
    </section>

    </div><!--box-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
      $(function(){

      clickMenu();
      scrollItem();
        function clickMenu(){
          $('#main-menu a, .list-group a').click(function(){
              $('.list-group a').removeClass('active').removeClass('standard-color');
              $('#main-menu a').parent().removeClass('active');
              // DEBUGGING FIRST LINE BELOW
              //console.log('#main-menu a[ref_sys='+$(this).attr('ref_sys')+']');
              $('#main-menu a[ref_sys='+$(this).attr('ref_sys')+']').parent().addClass('active');
              $('.list-group a[ref_sys='+$(this).attr('ref_sys')+']').addClass('active').addClass('standard-color');
            return false;
          })
        }

        function scrollItem(){
          $('#main-menu a, .list-group a').click(function(){
            var ref = '#'+$(this).attr('ref_sys')+'_section';
            var offset = $(ref).offset().top;
            $('html,body').animate({'scrollTop':offset-50});
            if($(window)[0].innerWidth <= 768){
            $('.icon-bar').click();
            }
          });
        }

        $('button.delete-member').click(function(){
            var id_member = $(this).attr('id_member');
            var el = $(this).parent().parent();
            $.ajax({
              method:'post',
              data:{'id_member':id_member},
              url:'delete.php'
            }).done(function(){
              el.fadeOut(function(){
              el.remove();
            });
            })
            
        })

        
      })
    </script>
  </body>
</html>