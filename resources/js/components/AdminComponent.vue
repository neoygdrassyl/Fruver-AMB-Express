<template>
  <div>
    <!-- Data Table -->

    <data-table
      :columns="columns"
      :data="data"
      url="/productos"
      :classes="classes"
      :per-page="perpage"
      :translate="translate"
      @on-table-props-changed="reloadTable"
    >
      <div
        slot="filters"
        slot-scope="{ tableFilters, perPage }"
        class="card bg-light border-primary mt-5"
      >
        <div class="row card-body">
          <div class="col">
            <div
              v-if="$attrs.user_rol == 1"
              class="btn btn-primary"
              data-toggle="modal"
              @click="abrirModal()"
              data-target="#modal"
            >
              <a><i class="fas fa-plus-square"></i> Añadir Producto</a>
            </div>
          </div>
          <div class="col">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="selectR">Resultados</label>
              </div>
              <select
                class="form-control"
                id="selectR"
                v-model="tableFilters.length"
              >
                <option :key="page" v-for="page in perPage">{{ page }}</option>
              </select>
            </div>
          </div>
          <div class="col">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="table-search"
                  ><i class="fas fa-search"></i
                ></label>
              </div>
              <input
                name="table-search"
                class="form-control"
                v-model="tableFilters.search"
                placeholder="Buscar Producto"
              />
            </div>
          </div>
        </div>
      </div>

      <tbody slot="body" slot-scope="{ data }">
        <tr :key="item.id" v-for="item in data">
          <td :key="column.name" v-for="column in columns">
            <data-table-cell
              :value="item"
              :name="column.name"
              :meta="column.meta"
              :comp="column.component"
              :classes="column.classes"
            >
            </data-table-cell>
            <slot v-if="column.label == 'Imagen'">
              <img
                v-bind:src="'/storage/assets/productos-img/' + item.imagen"
                alt=""
                width="120"
              />
            </slot>
            <slot v-if="column.label == 'Accion'">
              <div
                class="btn btn-warning"
                data-toggle="modal"
                @click="abrirModal(item)"
                data-target="#modal"
              >
                <a> <i class="fas fa-edit"></i></a>
              </div>
              <div
                class="btn btn-danger"
                v-if="$attrs.user_rol == 1"
                @click="eliminar(item.id)"
              >
                <a><i class="fas fa-trash-alt"></i></a>
              </div>

              <select class="btn btn-info" v-model="item.activo" @change="mostrar(item.id, $event.target.value)">
                <option value="1">Visible</option>
                <option value="0">Oculto</option>
              </select>
            </slot>
          </td>
        </tr>
      </tbody>
    </data-table>

    <!-- Modal Nuevo Producto-->
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
              <h5 class="modal-title" id="modal">{{ tituloModal }}</h5>
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
              <!-- Nombre Producto -->
              <div class="input-group mb-3" v-if="$attrs.user_rol == 1">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="nombre">Nombre</span>
                </div>
                <input
                  type="text"
                  class="form-control"
                  placeholder="nombre"
                  aria-label="nombre"
                  aria-describedby="nombre"
                  v-model="producto.nombre"
                  required
                />
              </div>
              <!-- Precio -->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="precio">Precio</span>
                </div>
                <input
                  type="number"
                  class="form-control"
                  placeholder="precio"
                  aria-label="precio"
                  aria-describedby="precio"
                  v-model="producto.precio"
                  required
                />
              </div>
              <!-- Unidad -->
              <div class="input-group mb-3" v-if="$attrs.user_rol == 1">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="unidad">Unidad</span>
                </div>
                <input
                  type="text"
                  class="form-control"
                  placeholder="unidad"
                  aria-label="unidad"
                  aria-describedby="unidad"
                  v-model="producto.unidad"
                  required
                />
              </div>
              <!-- Categoria -->
              <div class="input-group mb-3" v-if="$attrs.user_rol == 1">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="categoria"
                    >Categoria</label
                  >
                </div>
                <select
                  class="custom-select form-control"
                  id="categoria"
                  v-model="producto.categoria"
                  required
                >
                  <option
                    v-for="categoria in categorias"
                    v-bind:key="categoria.value"
                    v-bind:value="categoria.text"
                  >
                    {{ categoria.text }}
                  </option>
                </select>
              </div>
              <!-- Imagen -->
              <div class="input-group mb-3" v-if="$attrs.user_rol == 1">
                <div class="input-group-prepend">
                  <span class="input-group-text">Imagen</span>
                </div>
                <div class="custom-file">
                  <input
                    v-if="!edit"
                    type="file"
                    class="custom-file-input form-controls"
                    id="imagen1"
                    name="imagen"
                    accept=".jpg, .jpeg, .png"
                    @change="handleFileUpload(false)"
                    ref="file1"
                    required
                  />
                  <input
                    v-if="edit"
                    type="file"
                    class="custom-file-input form-controls"
                    id="imagen2"
                    name="imagen"
                    accept=".jpg, .jpeg, .png"
                    @change="handleFileUpload(true)"
                    ref="file2"
                  />
                  <label class="custom-file-label" for="imagen"
                    >Elige una imagen</label
                  >
                </div>
              </div>
              <!-- Buttons -->
            </div>
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
                v-if="!edit"
                @click="crear()"
              >
                Añadir Producto
              </button>
              <button
                type="submit"
                class="btn btn-primary"
                v-if="edit"
                @click="editar(producto.id)"
              >
                Editar Producto
              </button>
            </div>
          </form>
          <!--From End -->
        </div>
      </div>
    </div>
    <!-- End Modal -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      producto: {
        id: "",
        nombre: "",
        precio: "",
        unidad: "",
        categoria: "",
        imagen: null,
      },
      categorias: [
        { text: "Fruta", value: "0" },
        { text: "Verdura", value: "1" },
        { text: "Pulpas", value: "2" },
        { text: "Arepas", value: "3" },
        { text: "Huevos", value: "4" },
        { text: "Lacteos", value: "5" },
        { text: "Otros", value: "6" },
        { text: "Carne", value: "7" },
        { text: "Cerdo", value: "8" },
        { text: "Pollo", value: "9" },
        { text: "Pescado", value: "10" },
        { text: "Viceras", value: "11" },
      ],
      edit: false,
      tituloModal: "",
      // Data Table
      file: "",
      file1: "",
      file2: "",
      perpage: ["10", "25", "50"],
      data: {},
      columns: [
        {
          label: "ID",
          name: "id",
          orderable: true,
        },
        {
          label: "Imagen",
          name: "oferta",
          orderable: false,
        },
        {
          label: "Nombre",
          name: "nombre",
          orderable: true,
        },
        {
          label: "Precio",
          name: "precio",
          orderable: true,
        },
        {
          label: "Unidad",
          name: "unidad",
          orderable: true,
        },
        {
          label: "Categoria",
          name: "categoria",
          orderable: true,
        },
        {
          label: "Accion",
          filterable: false,
        },
      ],
      classes: {
        "table-container": {
          "table-responsive": true,
        },
        table: {
          table: true,
          "table-hover": true,
          "table-striped": false,
          border: true,
        },
        "t-head": {
          "thead-dark": true,
        },
      },
      translate: {
        nextButton: ">>",
        previousButton: "<<",
        placeholderSearch: "Buscar Producto",
      },
      tableProps: {
        search: "",
        length: 10,
        column: "id",
        dir: "asc",
      },
    };
  },
  methods: {
    // Methods
    async crear() {
      if (this.validate()) {
        let formData = this.getForm();
        const res = await axios.post("/productos", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });
        $("#modal").modal("hide");
        if (res) {
          this.$swal.fire("Producto creado", "", "success");
          this.reloadTable();
        } else {
          this.$swal.fire("Error, el producto no fue creado", "", "error");
          this.reloadTable();
        }
      }
    },
    eliminar(id) {
      this.$swal({
        title: "¿Esta seguro de eliminar este Producto?",
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
      const res = await axios.delete("/productos/" + id);
      if (res) {
        this.$swal.fire("Dato eliminado", "", "success");
        this.reloadTable();
      } else {
        this.$swal.fire("Error, el dato no se elimino", "", "error");
        this.reloadTable();
      }
    },
    async editar(id) {
      if (this.validate()) {
        let formData = this.getForm();
        formData.append("_method", "PUT");
        const res = await axios.post("/productos/" + id, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });
        $("#modal").modal("hide");
        if (res) {
          this.$swal.fire("Producto editado", "", "success");
          this.reloadTable();
        } else {
          this.$swal.fire("Error, el producto no fue editado", "", "error");
          this.reloadTable();
        }
      }
    },
    async mostrar(id, checked) {
      var value;
      if(checked == true){
        value = 1;
      }else{
        value = 0;
      }
      const res = await axios.get("/productos/active/" + id + "&" + value);
      if (res) {
        //this.reloadTable();
        this.$forceUpdate();
      } else {
        this.$swal.fire("Error, algo ha ocurrido", "", "error");
      }
    },
    async handleFileUpload(edit) {
      if (edit) {
        this.producto.imagen = this.$refs.file2.files[0];
      } else {
        this.producto.imagen = this.$refs.file1.files[0];
      }
    },
    validate() {
      var validate = true;
      if (this.$attrs.user_rol == 1) {
        if (this.producto.nombre == "") {
          validate = false;
        }
        if (this.producto.precio == "") {
          validate = false;
        }
        if (this.producto.unidad == "") {
          validate = false;
        }
        if (this.producto.categoria == "") {
          validate = false;
        }
        //if (this.producto.imagen == null) {
        //validate = false;
        //}
      } else {
        if (this.producto.precio == "") {
          validate = false;
        }
      }
      return validate;
    },
    getForm() {
      let formData = new FormData();
      formData.append("id", this.producto.id);
      formData.append("nombre", this.producto.nombre);
      formData.append("precio", this.producto.precio);
      formData.append("unidad", this.producto.unidad);
      formData.append("categoria", this.producto.categoria);
      formData.append("imagen", this.producto.imagen);
      return formData;
    },
    abrirModal(entry = null) {
      if (!entry) {
        this.tituloModal = "Crear Nuevo Articulo";
        this.edit = false;
        this.producto.id = "";
        this.producto.nombre = "";
        this.producto.precio = "";
        this.producto.unidad = "";
        this.producto.categoria = "";
        this.producto.imagen = null;
      } else {
        this.tituloModal = "Editar Articulo";
        this.edit = true;
        this.producto.id = entry.id;
        this.producto.nombre = entry.nombre;
        this.producto.precio = entry.precio;
        this.producto.unidad = entry.unidad;
        this.producto.categoria = entry.categoria;
        this.producto.imagen = null;
      }
    },
    async reloadTable(url = "/productos", options = this.tableProps) {
      axios
        .get(url, {
          params: options,
        })
        .then((response) => {
          this.data = response.data;
        })
        .catch((errors) => {});
    },
  }, // End Methods
  created() {
    // Hello world!
  },
};
</script>
