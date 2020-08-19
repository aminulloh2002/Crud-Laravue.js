
<template>
  <div>


    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
          <loading :active.sync="isLoading" 
        :is-full-page="true"
        :color="color"
        :loader="loader"
        :background-color="bgc"
        :opacity=0.2></loading>
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>Students</h4>
          </div>
          <div class="col-md-12 mt-2">
            <!-- push router ke form membuat data -->
            <!-- <form class="d-inline" @submit.prevent="searchquery(search)"> -->
            <form class="d-inline">
              <input class="form-control col-md-3 d-inline" v-model="search" @keyup="searchquery(search)" placeholder="Search something...">
               <!-- <button class="btn btn-primary">Search</button> -->
            </form>
             <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal" @click="cbtn">Add Data</button>
          </div>
        </div>
        <br>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">nisn</th>
              <th scope="col">nama</th>
              <th scope="col">kelas</th>
              <th scope="col">jurusan</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- menampilkan data ke table -->
            <tr v-for="(student,index) in students" :key="student.id">
              <td class="w20">{{student.nisn}}</td>
              <td class="w20">{{student.nama}}</td>
              <td class="w20">{{student.kelas}}</td>
              <td class="w20">{{student.jurusan}}</td>
              <td class="w20">
                <button class="btn btn-primary" @click="cbtn($event,student.id,index)" data-toggle="modal" data-target="#modal">Update</button>
                <button class="btn btn-danger" v-on:click="deleteData(student.id,index)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">{{lastclick}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ref="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>nisn</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input your nisn"
              v-model="form.nisn"
              @keydown="filter"
              required
            >
          </div>
          <div class="form-group">
            <label>nama</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input your name"
              v-model="form.nama"
              required
            >
          </div>
            <div class="form-group">
            <label>kelas</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input your class"
              v-model="form.kelas"
              @keydown="filter"
              required
            >
          </div>
          <div class="form-group">
            <label>jurusan</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input your jurusan"
              v-model="form.jurusan"
              required
            >
          </div>
          <button class="btn btn-primary d-none" ref="submit" @click.prevent="ngapain"></button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" @click="klik">Submit</button>
      </div>
    </div>
  </div>
</div>

  </div>
</template>

<!-- script js -->
<script>

import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

export default {
  data() {
    return {
      // variable array yang akan menampung hasil fetch dari api
      students: [],
      form:{
        nisn: '',
        nama: '',
        kelas: '',
        jurusan: ''
        },
      lastclick:'',
      iddata:'',
      search:'',
      index:'',
      isLoading:false,
      color:'#007BFF',
      loader:'spinner',
      bgc:'#BFBFBF'
    }
  },
  components:{
    Loading
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
    this.isLoading = true

      // fetch data dari api menggunakan axios
      axios.get(window.location.origin +"/api/students").then(response => {
        // mengirim data hasil fetch ke varibale array Students
        this.students = response.data
      this.isLoading = false
      })
    },
    deleteData(id,index) {
      // delete data
      this.$delete(this.students,index);
      axios.delete(window.location.origin +"/api/students/" + id).then(response => {
        //curhat gan, fitur melambatkan performa, performa mengurangi fitur, gw bingung gan pilih yg mana
        // this.students = response.data
        if (response.data !== 200) {
          this.loadData()
        }
      });
    },
    addData() {
      // post data ke api menggunakan axios
      this.isLoading = true
      axios
        .post(window.location.origin +"/api/students", {
          nisn: this.form.nisn,
          nama: this.form.nama,
          kelas: this.form.kelas,
          jurusan: this.form.jurusan
        })
        .then(response => {
          // push router ke read data
          //console.log(response.data)
        this.students.unshift(response.data);
        this.isLoading = false
        this.clearf()
        this.$refs.close.click()
        });
    },
    clearf(){
          let self = this
          Object.keys(this.form).forEach(function(key) {
          self.form[key] = ''
          })
    },
    filter(e){
            // console.log(e.shiftKey)
            if(e.shiftKey){
                e.preventDefault()
            }
            else if((e.keyCode<37 || e.keyCode >40) && (e.keyCode <48 || e.keyCode >57) && e.keyCode !=8 && e.keyCode !=9){
                e.preventDefault()
            }
        },
    klik(){
        this.$refs.submit.click()
    },
    searchquery(search){
      if(search == ''){
        this.loadData()
      } else {
      axios.get(window.location.origin +"/api/students/search/"+search).then(response => {
        // mengirim data hasil fetch ke varibale array Studentss
        this.students = response.data;
      })
    }
    },
    cbtn(e,id,index){
      this.lastclick = e.target.innerHTML
      if(this.lastclick === 'Update'){
        this.iddata = id
        this.loadUpdateData(id)
        this.index = index;
      }
    },

      loadUpdateData(id) {
      // load data berdasarkan id
      axios
        .get(window.location.origin +"/api/students/" + id)
        .then(response => {
          // post value yang dari response ke form
          this.form.nisn = response.data.nisn
          this.form.nama = response.data.nama
          this.form.kelas = response.data.kelas
          this.form.jurusan = response.data.jurusan
          
        });
    },
    updateArray(index){
      this.students[index].nisn = this.form.nisn
      this.students[index].nama = this.form.nama
      this.students[index].kelas = this.form.kelas
      this.students[index].jurusan = this.form.jurusan
      this.$refs.close.click()
      this.updateData()
    },
    updateData() {
      // put data ke api menggunakan axios
      
      axios
        .put(window.location.origin +"/api/students/" + this.iddata, {
          nisn: this.form.nisn,
          nama: this.form.nama,
          kelas: this.form.kelas,
          jurusan: this.form.jurusan
        })
        .then(response => {
          if(response.data != 1){
            this.loadData()
          }
          this.clearf()

        });
    },
    ngapain(){
      if(this.lastclick === "Add Data"){
        this.addData()
      } else if(this.lastclick === "Update"){
        this.updateArray(this.index)
      }
    }

  }
};

</script>