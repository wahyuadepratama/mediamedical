<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Media Medical">
    <title>Admin - Media Medical</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="/views/theme/css/main.css" rel="stylesheet" />
    <meta name="description"
        content="PT. Media Indotama Expo (Group) Dipercaya lebih dari 200.000++ Alumni dan Brand Ternama di Indonesia dalam bermitra serta memberikan pelatihan pengembangan karir dan kompetensi profesi.">
    <link rel="shortcut icon" href="/views/theme/images/icon.jpeg">
    <meta property="og:title" content="Media Medical">
    <meta property="og:url" content="https://mediamedical.org/">
    <meta property="og:description"
        content="PT. Media Indotama Expo (Group) Dipercaya lebih dari 200.000++ Alumni dan Brand Ternama di Indonesia dalam bermitra serta memberikan pelatihan pengembangan karir dan kompetensi profesi.">
    <meta property="og:image" content="/views/theme/images/icon.jpeg">
    <link rel="shortcut icon" href="/views/theme/images/icon.png" type="image/png">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Vue JS -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <!-- Slick Loader -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/slick-loader@1.1.20/slick-loader.min.css">
    <script src="https://unpkg.com/slick-loader@1.1.20/slick-loader.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Icon -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- MD5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.19.0/js/md5.min.js"></script>
    <!-- Datatable -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <!-- CSS Custom -->
    <style media="screen">
      .card{border-radius: 20px !important;background-color: #f8f9fad6;}
      .img-center{display: block;margin-left: auto;margin-right: auto;}
      .s130 form{padding-top: 15vh;max-width: 400px;}
      .s130{background: white !important}
    </style>
  </head>
  <body>

    <div id="app" style="display:none">
      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/">
          <img src="/views/theme/images/logo.png" height="50" class="d-inline-block align-top" style="margin-left:30px">
        </a>
        <div style="margin-left:auto;margin-right:15px">
          Welcome <?= $_SESSION['logged_in_user_name'] ?>
        </div>
        <a href="/admin/logout" onclick="return confirm('Are you sure?');" class="btn btn-sm btn-danger float-right" style="margin-right:30px">Logout &nbsp; <i class="fa fa-arrow-right"></i> </a>
      </nav>

      <div class="container mt-5">

        <div style="float:right">
          <button class="btn btn-success mb-3" style="background-color:#11339f" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Add Data</button> &nbsp;
          <button class="btn btn-danger mb-3" @click="onMultipleDelete" v-if="selected_data.length == 0" disabled> <li class="fa fa-trash"></li> Delete Selected Data</button>
          <button class="btn btn-danger mb-3" @click="onMultipleDelete" v-if="selected_data.length > 0"> <li class="fa fa-trash"></li> Delete Selected Data</button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label class="mb-2">Upload Excel</label>
                  <input type="file" class="form-control" @change="onUpload" ref="inputFile">
                </div>
                <div class="form-group mt-3">
                  <a href="/raw/sample_data.xlsx" target="_blank">Download Sample Format File Excel</a>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="processUpload" data-bs-dismiss="modal">Upload</button>
              </div>
            </div>
          </div>
        </div>

        <div class="btn-group">
          <select class="form-select" @change="onLimit()" v-model="limit_data">
            <option value="100">Show 100 Data</option>
            <option value="500">Show 500 Data</option>
            <option value="1000">Show 1000 Data</option>
            <option value="5000">Show 5000 Data</option>
            <option value="10000">Show 10.000 Data</option>
            <option value="50000">Show 50.000 Data</option>
            <option value="100000">Show 100.000 Data</option>
            <option value="500000">Show 500.000 Data</option>
          </select>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Filter By No. Reg, Name, Place of Origin or Event Title"
          aria-describedby="button-addon2" v-model="search" v-on:keyup.enter="onSearch">
          <button class="btn btn-outline-secondary" type="button" id="button-addon2" @click="onSearch()">Filter Data</button>
          <button class="btn btn-outline-secondary" type="button" id="button-addon2" @click="onClear()">Clear</button>
        </div>

      </div>

      <div class="container mt-2">
        <div class="row">
          <center><h6>Total Data: {{ total_data }}</h6></center>
        </div>
      </div>

      <div class="container mt-3">
        <div class="col-md-12 table-responsive">
          <table class="table table-striped table-hover" id="datatable">
            <thead>
              <th></th>
              <th>No</th>
              <th>No Reg</th>
              <th>Name</th>
              <th>Regional</th>
              <th>Event Title</th>
              <th>Action</th>
            </thead>
            <tbody>
              <tr v-for="(item, index) in data">
                <td>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" @click="onSelect(item, index)" :id="'checkbox'+index">
                  </div>
                </td>
                <td>{{index+1}}</td>
                <td>{{ item.no_reg }}</td>
                <td>{{ item.nama }}</td>
                <td>{{ item.asal_daerah }}</td>
                <td>{{ item.judul_event }}</td>
                <td>
                  <button type="button" class="btn btn-sm btn-danger"> <li class="fa fa-trash" @click="onDelete(item)"></li> </button>
                  <button type="button" class="btn btn-sm btn-warning" style="color:white" data-bs-toggle="modal" data-bs-target="#update"
                  @click="onEdit(item)"> <li class="fa fa-pencil"></li> </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <br><br>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="form-group mb-2">
                <label>No. Reg</label>
                <input type="text" v-model="detail.no_reg" class="form-control" disabled>
              </div>
              <div class="form-group mb-2">
                <label>Name</label>
                <input type="text" v-model="detail.nama" class="form-control">
              </div>
              <div class="form-group mb-2">
                <label>Regional</label>
                <input type="text" v-model="detail.asal_daerah" class="form-control">
              </div>
              <div class="form-group mb-2">
                <label>Event Title</label>
                <input type="text" v-model="detail.judul_event" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" @click="onUpdate" data-bs-dismiss="modal">Update</button>
            </div>
          </div>
        </div>
      </div>

    </div>

    <script src="/views/theme/js/extention/choices.js"></script>
    <!-- Read excel -->
    <script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Data table -->
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" charset="utf-8"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js" charset="utf-8"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js" charset="utf-8"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js" charset="utf-8"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
      var vue = new Vue({
        el: '#app',
        data: {
          data: '',
          isFound: '-',
          search: '',
          formData: '',
          total_data: '',
          detail: '',
          limit_data: 100,
          checkbox: '',
          selected_data: []
        },
        mounted(){
          this.refreshData();
          $('#app').css('display', 'block');
        },
        methods:{
          refreshData(){
            $('#datatable').DataTable().destroy();
            SlickLoader.enable();
            axios.get('/admin/data/all?data='+this.search+'&limit='+this.limit_data)
            .then(response => {
              this.data = response.data.data;
              this.total_data = response.data.total_data;
              console.log(response.data);
              setTimeout(function(){
                  $('#datatable').DataTable( {
                      "order": [[ 0, "asc" ]],
                      // "paging": false,
                      "lengthChange": false,
                      // "ordering": false,
                      "searching": false,
                      dom: 'Bfrtip',
                      buttons: [
                          'copy',
                          {
                              extend: 'excelHtml5',
                              exportOptions: {
                                  columns: [ 1, 2, 3, 4, 5 ]
                              }
                          },
                      ]
                  }).draw();
                  SlickLoader.disable();
              }, 1000);
            })
          },
          onLimit(){
            SlickLoader.enable();
            $('#datatable').DataTable().destroy();
            axios.get('/admin/data/all?data='+this.search+'&limit='+this.limit_data)
            .then(response => {
              this.data = response.data.data;
              this.total_data = response.data.total_data;
              setTimeout(function(){
                  $('#datatable').DataTable( {
                    "order": [[ 0, "asc" ]],
                    // "paging": false,
                    "lengthChange": false,
                    // "ordering": false,
                    "searching": false,
                    dom: 'Bfrtip',
                    buttons: [
                        'copy',
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4, 5 ]
                            }
                        },
                    ]
                  }).draw();
                  SlickLoader.disable();
              }, 1000);
            })
          },
          onSearch(){
            $('#datatable').DataTable().destroy();
            SlickLoader.enable();
            axios.get('/admin/data/all?data='+this.search+'&limit='+this.limit_data)
            .then(response => {
              this.data = response.data.data;
              this.total_data = response.data.total_data;
              setTimeout(function(){
                  $('#datatable').DataTable( {
                    "order": [[ 0, "asc" ]],
                    // "paging": false,
                    "lengthChange": false,
                    // "ordering": false,
                    "searching": false,
                    dom: 'Bfrtip',
                    buttons: [
                        'copy',
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4, 5 ]
                            }
                        },
                    ]
                  }).draw();
                  SlickLoader.disable();
              }, 1000);
            })
          },
          onUpload(event){
            SlickLoader.enable();
            let xlsxfile = event.target.files ? event.target.files[0] : null;
            const schema = {
              'No Reg': {
                prop: 'No Reg'
              },
              'Nama': {
                prop: 'Nama'
              },
              'Asal Daerah': {
                prop:'Asal Daerah'
              },
              'Judul Event': {
                prop:'Judul Event'
              }
            };

            readXlsxFile(xlsxfile,{schema}).then((rows) => {
              const bodyFormData = new FormData();
              let count = 0;
              rows.rows.forEach((item) => {
                // console.log(item);
                count++;
                bodyFormData.append("data_excel[]", JSON.stringify(item));
              });
              console.log("total data: "+count);
              this.formData = bodyFormData;
              SlickLoader.disable();
            });
          },
          processUpload(){
            if (this.formData == "") {
              confirm("Please input data first!");
            }else {
              SlickLoader.enable();
              axios.post('/admin/data/store', this.formData)
              .then(response => {
                console.log(response.data);
                this.refreshData();

                SlickLoader.disable();
                this.$refs.inputFile.value=null;
                this.formData = '';
              })
            }
          },
          onDelete(item){
            let isExecuted = confirm("Are you sure to delete this one?");
            if (isExecuted) {
              let isExecuted = confirm("Are you really sure?");
              if (isExecuted) {
                SlickLoader.enable();
                axios.post('/admin/data/delete?id='+item.no_reg)
                .then(response => {
                  this.limit_data = 100;
                  this.search = '';
                  this.refreshData();
                  toastr.success("No Reg "+item.no_reg+" atas nama "+item.nama+" deleted successfully!")
                })
              }
            }
          },
          onEdit(d){
            this.detail = d;
          },
          onUpdate(){
            SlickLoader.enable();

            const formData = new FormData();
            formData.append('nama', this.detail.nama);
            formData.append('asal_daerah', this.detail.asal_daerah);
            formData.append('judul_event', this.detail.judul_event);

            axios.post('/admin/data/update?id='+this.detail.no_reg, formData)
            .then(response => {
              this.refreshData();
              toastr.success("No Reg "+this.detail.no_reg+" updated successfully!")
            })
          },
          onSelect(v, index){
            console.log($("#checkbox"+index).is(":checked"));
            if ($("#checkbox"+index).is(":checked")) {
              this.selected_data.push(v);
            }else {
              this.selected_data = this.selected_data.filter(data => data.no_reg != v.no_reg);
            }
            console.log("Total Selected Row: "+this.selected_data.length);
            console.log(this.selected_data);
          },
          onMultipleDelete(){
            let isExecuted = confirm("Are you sure to delete this one?");
            if (isExecuted) {
              let isExecuted = confirm("Are you really sure?");
              if (isExecuted) {
                const bodyFormData = new FormData();
                let count=0;
                this.selected_data.forEach((item) => {
                  $("#checkbox"+count).prop('checked', false);
                  bodyFormData.append("data[]", JSON.stringify(item));
                  count++;
                });

                axios.post('/admin/data/delete/multiple', bodyFormData)
                .then(response => {
                  console.log(response.data);
                  if (response.data.success) {
                    this.refreshData();
                    this.selected_data.forEach((item) => {
                      $("#checkbox"+this.data.indexOf(item)).prop('checked', false);
                    });
                    this.selected_data = [];
                    console.log("Total Selected Row: "+this.selected_data.length);
                    toastr.success(count+" data deleted successfully!")
                  }
                });
              }
            }
          },
          onClear(){
            this.limit_data = 100;
            this.search = '';
            this.refreshData();
          }
        }
      });
    </script>
  </body>
</html>
