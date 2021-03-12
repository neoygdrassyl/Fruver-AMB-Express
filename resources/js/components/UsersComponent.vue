<template>
  <div class="container">
    <div class="card bg-light border-primary">
      <div class="row card-body">
        <div class="col-3">
          <a href="/register" class="btn btn-primary"
            ><i class="fas fa-plus-square"></i> Añadir usuario</a
          >
        </div>
        <div class="col text-center">
         
        </div>
      </div>
    </div>
    <table class="table table-hover  mb-3">
      <thead class="thead-dark">
        <tr>
          <th>Usuario</th>
          <th>Email</th>
          <th>Rol</th>
          <th>Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" v-bind:key="user.id">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ getRol(user.rol) }}</td>
          <td>
            <div
                class="btn btn-warning"
                data-toggle="modal"
                @click="abrirModal(user)"
                data-target="#modal"
            >
                <a> <i class="fas fa-edit"></i></a>
            </div>
            <div
                class="btn btn-danger"
                @click="eliminar(user.id)"
              >
                <a><i class="fas fa-trash-alt"></i></a>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- MODAL -->
    <div
      class="modal fade"
      id="modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content form-group">
          <form class="needs-validation" id="form" v-on:submit.prevent>
            <!--From Start -->
            <div class="modal-header bg-primary bg-gradient">
              <h5 class="modal-title" id="modal">ACTUALIZAR USURIO</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- User Name -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="nombre">Nombre</span>
                </div>
                <input
                  type="text"
                  class="form-control"
                  placeholder="nombre"
                  aria-label="nombre"
                  aria-describedby="nombre"
                  v-model="user.name"
                  required
                />
              </div>
              <!-- Email -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="email">Email</span>
                </div>
                <input
                  type="email"
                  class="form-control"
                  placeholder="email"
                  aria-label="email"
                  aria-describedby="email"
                  v-model="user.email"
                  required
                />
              </div>
              <!-- Rol -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="rol">Rol</span>
                </div>
                    <select name="rol" id="rol" v-model="user.rol" class="custom-select form-control">
                        <option value="1">ADMINISTRADOR</option>
                        <option value="2">VENDEDOR</option>
                    </select>
              </div>
              <!-- Password -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="password"
                    >Password</label
                  >
                </div>
                <input
                  type="password"
                  class="form-control"
                  placeholder="password"
                  aria-label="password"
                  aria-describedby="categoria"
                  v-model="user.password"
                />
              </div>
              <!-- Buttons -->
            <div class="modal-footer bg-dark bg-gradient">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Cerrar
              </button>
              <button
                type="submit"
                class="btn btn-primary"
                @click="editar(user.id)"
              >
                Actualizar Usuario
              </button>
            </div>
            </div>
          </form>
          <!--From End -->
        </div>
      </div>
    </div>

  </div>
</template>
<script>
export default {
  data() {
    return {
      users: [],
      user:{
          'id': '',
          'name':'',
          'email':'',
          'rol':'',
          'password':'',
      },
    };
  },
  // Methods
  methods: {
    async loadUsers() {
      const res = await axios.get("/users");
      this.users = res.data;
    },
    getRol(value) {
      if (value == 1) {
        return "ADMINISTRADOR";
      } else {
        return "VENDEDOR";
      }
    },
    eliminar(id) {
      this.$swal({
        title: "¿Esta seguro de eliminar este Usuario?",
        text: "El item será eliminado permanentemente.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          this.delete(id);
        }
      });
    },
    async delete(id) {
      const res = await axios.delete("/users/" + id);
      if (res) {
        this.$swal.fire("Usuario eliminado", "", "success");
        this.loadUsers();
      } else {
        this.$swal.fire("Error, el Usuario no se elimino", "", "error");
        this.loadUsers();
      }
    },
    async editar(id) {
      if (this.validate()) {
        let formData = this.getForm();
        formData.append("_method", "PUT");
        const res = await axios.post("/users/" + id, formData);
        $("#modal").modal("hide");
        if (res) {
          this.$swal.fire("Usuario actualizado", "", "success");
          this.loadUsers();
        } else {
          this.$swal.fire("Error, el Usuario no fue actualizado", "", "error");
          this.loadUsers();
        }
      }
    },
    validate() {
      var validate = true;
        if (this.user.name == "") {
          validate = false;
        }
        if (this.user.email == "") {
          validate = false;
        }
        if (this.user.rol == "") {
          validate = false;
        }
      return validate;
    },
    getForm() {
      let formData = new FormData();
      formData.append("name", this.user.name);
      formData.append("email", this.user.email);
      formData.append("rol", this.user.rol);
      formData.append("password", this.user.password);
      return formData;
    },
    abrirModal(entry = null) {
        this.user.id = entry.id;
        this.user.name = entry.name;
        this.user.email = entry.email;
        this.user.rol = entry.rol;
        this.user.password = "";
    },
  },
  // End Methods
  created() {
    this.loadUsers();
  },
};
</script>