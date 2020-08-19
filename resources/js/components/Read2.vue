
<template>
  <div>
    <!-- disini saya menggunakan bootstrap untuk design tabel nya. secara default bootstrap sudah di include di file welcome.blade.php jadi saya tidak perlu lagi untuk import file nya -->
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <div class="row">
          <div class="col-md-10">
            <h4>Students</h4>
          </div>
          <div class="col-md-2">
            <!-- push router ke form membuat data -->
            <router-link class="btn btn-primary w-100" to="/create">+ Tambah</router-link>
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
            <tr v-for="student in students" :key="student.id">
              <td style="width:20%">{{student.nisn}}</td>
              <td style="width:20%">{{student.nama}}</td>
              <td style="width:20%">{{student.kelas}}</td>
              <td style="width:20%">{{student.jurusan}}</td>
              <td style="width:20%">
                <router-link class="btn btn-primary" :to="'/detail/'+student.id">Update</router-link>
                <button class="btn btn-danger" v-on:click="deleteData(student.id)">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<!-- script js -->
<script>
export default {
  data() {
    return {
      // variable array yang akan menampung hasil fetch dari api
      students: []
    };
  },
  created() {
    this.loadData();
  },
  methods: {
    loadData() {
      // fetch data dari api menggunakan axios
      axios.get("http://localhost:8000/api/students").then(response => {
        // mengirim data hasil fetch ke varibale array Studentss
        this.students = response.data;
      });
    },
    deleteData(id) {
      // delete data
      axios.delete("http://localhost:8000/api/students/" + id).then(response => {
        this.loadData();
      });
    }
  }
};
</script>