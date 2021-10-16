<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Media Medical">
    <title>Admin - Media Medical</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="views/theme/css/main.css" rel="stylesheet" />
    <meta name="description"
        content="PT. Media Indotama Expo (Group) Dipercaya lebih dari 200.000++ Alumni dan Brand Ternama di Indonesia dalam bermitra serta memberikan pelatihan pengembangan karir dan kompetensi profesi.">
    <link rel="shortcut icon" href="views/theme/images/icon.jpeg">
    <meta property="og:title" content="Media Medical">
    <meta property="og:url" content="https://mediamedical.org/">
    <meta property="og:description"
        content="PT. Media Indotama Expo (Group) Dipercaya lebih dari 200.000++ Alumni dan Brand Ternama di Indonesia dalam bermitra serta memberikan pelatihan pengembangan karir dan kompetensi profesi.">
    <meta property="og:image" content="views/theme/images/icon.jpeg">
    <link rel="shortcut icon" href="/views/theme/images/icon.png" type="image/png">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Vue JS -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <!-- Slick Loader -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/slick-loader@1.1.20/slick-loader.min.css">
    <script src="https://unpkg.com/slick-loader@1.1.20/slick-loader.min.js"></script>
    <!-- Icon -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- MD5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"></script>
    <!-- CSS Custom -->
    <style media="screen">
      .card{border-radius: 20px !important;background-color: #f8f9fad6;}
      .img-center{display: block;margin-left: auto;margin-right: auto;}
      .s130 form{padding-top: 15vh;max-width: 400px;}
      .s130{background: white !important}
    </style>
  </head>
  <body>
    <div class="s130" id="app">
      <form v-on:submit.prevent>
        <img src="views/theme/images/logo.png" width="200px" class="img-center mb-5">
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Username" v-model="username">
              <input type="password" class="form-control mt-2" placeholder="Password" v-model="password">
              <button style="background-color:#11339f" type="submit" class="btn btn-sm btn-success form-control mt-3"
              @click="login"> <i class="fa fa-arrow-right"></i> &nbsp; Login</button>

              <center class="mb-3 text text-danger mt-3" v-if="isFound == 0"> Username atau Password Kamu Salah!</center>
            </div>
          </div>
        </div>

        <center>
          <a href="/" class="btn btn-sm btn-danger mt-5">
            <i class="fa fa-arrow-left"></i> &nbsp; Kembali &nbsp;
          </a>
        </center>

      </form>
    </div>
    <script src="views/theme/js/extention/choices.js"></script>
    <script type="text/javascript">
      var vue = new Vue({
        el: '#app',
        data: {
          username: '',
          password: '',
          data: '',
          isFound: '-',
          result: ''
        },
        methods:{
          login(){
            SlickLoader.enable();
            var hash = md5(this.password);
            console.log(hash);
            let formData = new FormData();
            formData.append('username', this.username);
            formData.append('password', hash);

            axios.post('/admin/login', formData)
  		      .then(response => {
              console.log(response.data);
              console.log(response.data.success);
              if (response.data.success) {
                window.location.href = "/admin/home";
              }else {
                this.isFound = 0;
              }
  		        SlickLoader.disable();
  		      })
          }
        }
      });
    </script>
  </body>
</html>
