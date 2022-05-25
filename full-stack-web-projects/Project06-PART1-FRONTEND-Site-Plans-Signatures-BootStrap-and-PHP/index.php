<?php
  $pdo = new PDO('mysql:host=localhost;dbname=bootstrap_cms_project07','root','');
  $about = $pdo->prepare("SELECT * FROM `tb_about`");
  $about->execute();
  $about = $about->fetch()['about'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Front Web - CMS</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
   
    <nav class="navbar navbar-default navbar-fixed-top">
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
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="">Home</a></li>
            <li><a href="about">About</a></li>
            <li><a href="contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="box">
      <section class="banner">
        <div class="overlay"></div>
        <div class="container call-banner">
          <div class="row">
              <div class="col-md-12 text-center">
                  <h2><?php echo htmlentities('<'); ?>CybertimeUP<?php echo htmlentities('>');  ?></h2>
                  <p>Company focused on web development and digital marketing</p>
                  <a href="">Learn More!</a>
              </div><!--col-md-12-->
          </div><!--row-->
        </div>
      </section>
      <section class="register-lead">
          <div class="container">
            <div class="row text-center">
                <div class="col-md-6">
                  <h2><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Join our list!</h2>
                </div>
                <div class="col-md-6">
                  <form method="post">
                    <input type="text" name="name" /><input type="submit" value="Send" />
                  </form>
                </div>
            </div>
          </div>
      </section>

      <section class="testimonial text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  <h2>Testimonial</h2>
                    <blockquote>
                      <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget lorem varius, pellentesque ipsum convallis, suscipit neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam quis orci quam. Phasellus dictum erat at nibh bibendum, eget porta urna pretium. Maecenas vel augue massa. Nulla facilisi. Nulla a suscipit quam, eu pharetra justo."</p>
                  </blockquote>
                </div>
            </div>
        </div>
      </section>

    <section class="differentials text-center">
      <h2>Meet our company</h2>
        <div class="container differentials-container">
            <div class="row"><?php echo $about; ?></div>
        </div>
      </section>

      <section class="team">
        <h2>Team</h2>
        <div class="container team-container">
            <div class="row">    
              <?php
                $selectMembers = $pdo->prepare("SELECT * FROM `tb_team`");
                $selectMembers->execute();
                $members = $selectMembers->fetchAll();
                for($i = 0; $i < count($members); $i++){
              ?>           
                <div class="col-md-6">
                    <div class="team-single">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="user-picture">
                                  <div class="user-picture-child"><span class="glyphicon glyphicon-user"></span></div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <h3><?php echo $members[$i]['name'] ?></h3>
                                <p><?php echo $members[$i]['description']; ?></p>
                            </div>
                        </div>
                    </div>
                </div> 
                <?php } ?>
            </div>
        </div><!--team-container-->
      </section><!--team-->
      
      <section class="final-site">
          <div class="container">
              <div class="row">

                  <div class="col-md-6">
                    <h2>Contact us</h2>
                    <form>
                        <div class="form-group">
                          <label for="email">Name:</label>
                          <input type="text" name="name" class="form-control" id="name">
                        </div>

                         <div class="form-group">
                          <label for="email">E-mail:</label>
                          <input type="email" name="email" class="form-control" id="email">
                        </div>

                         <div class="form-group">
                          <label for="email">Message:</label>
                          <textarea class="form-control"></textarea>
                        </div>
                      
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>

                  <div class="col-md-6">
                      <h2>Our plans</h2>
                        <table class="table">
                            <thead>
                              <tr>
                                <th>Week Plan</th>
                                <th>Day Plan</th>
                                <th>Annual Plan</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>US$39,99</td>
                                <td>R$59,99</td>
                                <td>US$79,99</td>
                              </tr>

                              <tr>
                                <td>US$39,99</td>
                                <td>R$59,99</td>
                                <td>US$79,99</td>
                              </tr>

                               <tr>
                                <td>US$39,99</td>
                                <td>R$59,99</td>
                                <td>US$79,99</td>
                              </tr>
                            </tbody>
                          </table>
                  </div>

              </div>
          </div>
      </section>

      <footer>
        <p class="text-center">Copyright © CybertimeUP ® CNPJ: 35.643.031/0001-45.</p>
      </footer>

    </div><!--box-->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
