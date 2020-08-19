<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Create new data</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function addData() -->
        <form @submit.prevent="addData()">
          <div class="form-group">
            <label>nisn</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input your nisn"
              v-model="form.nisn"
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
          <button class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      form:{
        nisn: '',
        nama: '',
        kelas: '',
        jurusan: ''
      }
    }
  },
  methods: {
    addData() {
      // post data ke api menggunakan axios
      axios
        .post("http://localhost:8000/api/students", {
          nisn: this.form.nisn,
          nama: this.form.nama,
          kelas: this.form.kelas,
          jurusan: this.form.jurusan
        })
        .then(response => {
          // push router ke read data
          this.$router.push("/");
        });
    }
  }
};
</script>