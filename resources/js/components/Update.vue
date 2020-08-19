<template>
  <div>
    <div class="row">
      <div class="col-md-6">
        <br>
        <br>
        <h4>Update data</h4>
        <br>
        <!-- prevent form submit untuk reload halaman, kemudian memanggil function updateData() -->
        <form @submit.prevent="updateData()">
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
              placeholder="Input your nama"
              v-model="form.nama"
              required
            >
          </div>
          <div class="form-group">
            <label>kelas</label>
            <input
              type="textfield"
              class="form-control"
              placeholder="Input your kelas"
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
  data() {
    return {
      form: {
        nisn: "",
        nama: "",
        kelas: "",
        jurusan: ""
      }
    };
  },
  created() {
    // load data saat pertama kali halaman dibuka
    this.loadData();
  },
  methods: {
    loadData() {
      // load data berdasarkan id
      axios
        .get(window.location.origin+"/api/students/" + this.$route.params.id)
        .then(response => {
          // post value yang dari response ke form
          this.form.nisn = response.data.nisn;
          this.form.nama = response.data.nama;
          this.form.kelas = response.data.kelas;
          this.form.jurusan = response.data.jurusan;
          console.log(response.data);
        });
    },
    updateData() {
      // put data ke api menggunakan axios
      axios
        .put(window.location.origin+"/api/students/" + this.$route.params.id, {
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
