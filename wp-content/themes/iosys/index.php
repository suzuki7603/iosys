<?php get_header(); ?>

  <?php apply_filters('get_about', null); // ご挨拶 ?>

  <?php apply_filters('get_service', null); // イオシスでやっていること ?>
  

<!--  <section id="highlights">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
             Indicators 
            <ol class="carousel-indicators vertical">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

             Wrapper for slides 
            <div class="carousel-inner">
              <div class="item active">
                <img src="img/samples/600-300/2.jpg" alt="">
              </div>
              <div class="item">
                <img src="img/samples/600-300/3.jpg" alt="">
              </div>
              <div class="item">
                <img src="img/samples/600-300/1.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <h4>Company highlights</h4>
          <h5>This is how we have aachieved the success!</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, nisi, debitis, quia molestiae ipsa dolores beatae eaque nulla tempora deserunt sunt suscipit quisquam laborum magnam aut reiciendis sed pariatur totam!</p>
          <ul>
            <li>Aenean sodales justo in neque adipiscing pulvinar.</li>
            <li>Vivamus faucibus nisi et fermentum mattis.</li>
            <li>Proin commodo lorem non gravida varius.</li>
            <li>Proin condimentum lacus sed tristique lacinia.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>-->

  <?php apply_filters('get_recruit', null); // 一緒に働きませんか ?>
  
  <?php apply_filters('get_company', null); // 会社概要 ?>

  <section id="get-in-touch">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-push-2 clearfix">
          <div class="section-heading scrollpoint sp-effect3">
            <h1>お問い合わせ</h1>
            <h4></h4>
            <!--<span class="divider"></span>-->
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="contact-details">
            <div class="detail">
              <img src="img/samples/sample_contact.jpg" width="100" alt="">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <form>
            <div class="form-group has-feedback left">
              <input type="text" class="form-control" placeholder="NAME">
              <i class="fa fa-user form-control-feedback"></i>
            </div>
            <div class="form-group has-feedback left">
              <input type="email" class="form-control" placeholder="Email">
              <i class="fa fa-envelope-o form-control-feedback"></i>
            </div>
            <div class="form-group has-feedback left">
              <textarea class="form-control" rows="7" placeholder="MESSAGE"></textarea>
              <i class="fa fa-pencil-square-o form-control-feedback"></i>
            </div>
              
            <button class="btn btn-primary btn-lg pull-right" type="submit">SUBMIT</button>
            
          </form>
        </div>
      </div>
    </div>
  </section>

<!--  <section id="map"></section>-->

<?php get_footer(); ?>