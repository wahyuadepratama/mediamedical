<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Media Medical">
    <title>Media Medical</title>
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
    <link rel="shortcut icon" href="views/theme/images/icon.png" type="image/png">

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
    <!-- CSS Custom -->
    <style media="screen">
      .card{border-radius: 20px !important;background-color: #f8f9fad6;}
      .img-center{display: block;margin-left: auto;margin-right: auto;}
      .s130 form{padding-top: 0px;}
      .s130{min-height: 75vh !important;}
      td{vertical-align:top !important;}
      table{width: 100%}
      .s130 form .inner-form .input-field.first-wrap{background: #d2e4ff;}
    </style>
  </head>
  <body>
    <div class="s130" id="app">
      <form v-on:submit.prevent>
        <!-- <img src="views/theme/images/logo.png" width="300px" class="img-center mb-5"> -->
        <img src="views/theme/images/header.jpeg" class="img-fluid mb-5" alt="Responsive image" style="border-radius:10px;vertical-align: top !important">

        <div class="inner-form mt-3">
          <div class="input-field first-wrap">
            <div class="svg-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
              </svg>
            </div>
            <input id="search" type="text" placeholder="Input No. Reg" v-model="data" />
          </div>
          <div class="input-field second-wrap">
            <button class="btn-search" type="submit" @click="onSubmit" style="background-color:#11339f">SEARCH</button>
          </div>
        </div>
        <center class="mb-4"> <small>Please insert last 6 digit of your certificate registration number <br>(Masukkan 6 digit terakhir no. Registrasi sertifikat anda)</small> </center>

        <div class="card" v-if="isFound == 0">
          <div class="card-body">
            <center class="mb-3 text text-danger">Data Not Found!</center>
          </div>
        </div>

        <div class="card" v-if="isFound == 1">
          <div class="card-body">
            <center class="mb-3 text text-success">Data Found!</center>
            <table>
              <tr>
                <td style="width:20%">No Reg</td>
                <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                <td>{{ result.no_reg }}</td>
              </tr>
              <tr>
                <td>Name</td>
                <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                <td>{{ result.nama }}</td>
              </tr>
              <tr>
                <td>Regional</td>
                <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                <td>{{ result.asal_daerah }}</td>
              </tr>
              <tr>
                <td>Event Title</td>
                <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                <td>{{ result.judul_event }}</td>
              </tr>
            </table>
          </div>
        </div>

        <center>
          <button class="btn btn-danger mt-3" @click="onReset">
            <i class="fa fa-sync"></i> &nbsp; Reset &nbsp;
          </button>
        </center>

      </form>

    </div>

    <center>
      <img src="/views/theme/images/logo.png"
      width="150px" alt="">
      <h5 class="mt-3">Media Medical</h5>
      <p>www.MediaMedical.org</p>
      <!-- <p>
        Informasi dan Kerjasama :<br>
        0822-1112-5010 (WhatsApp Ready)
      </p> -->
    </center>

    <script src="views/theme/js/extention/choices.js"></script>
    <script type="text/javascript">
      var vue = new Vue({
        el: '#app',
        data: {
          data: '',
          isFound: '-',
          result: ''
        },
        methods:{
          onSubmit(){
            console.log('Searching ... '+this.data);
            SlickLoader.enable();
            axios.get('/search?data='+this.data)
  		      .then(response => {
              if (response.data.success) {
                this.isFound = 1;
                this.result = response.data.data;
              }else {
                this.isFound = 0;
              }
  		        SlickLoader.disable();
  		      })
          },
          onReset(){
            this.data = '';
            this.isFound = '-';
          }
        }
      });
    </script>
  </body>
</html>
