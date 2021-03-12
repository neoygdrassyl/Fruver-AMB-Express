<template>
  <div>
    <data-table
      :columns="columns"
      :data="data"
      :filters="filters"
      url="/productos"
      :classes="classes"
      :per-page="perpage"
      :translate="translate"
      @on-table-props-changed="reloadTable"
    >
      <!-- Filters -->
      <div
        slot="filters"
        slot-scope="{ tableFilters, perPage }"
        class="card bg-light border-primary mt-5"
      >
        <div class="row card-body">
          <div class="col">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="selectR">CATEGORIA</label>
              </div>
              <select
                class="form-control"
                id="selectC"
                name="SelectC"
                v-model="tableFilters.categoria"
              >
                <option :key="categoria" v-for="categoria in categorias">
                  {{ categoria }}
                </option>
              </select>
            </div>
          </div>
          <div class="col-auto">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="selectR">RESULTADOS</label>
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
      <!-- T Head -->
      <thead class="thead-dark" slot="header">
        <tr>
          <th class="text-center" colspan="3">PRODUCTOS</th>
        </tr>
      </thead>
      <!-- T Body -->
      <tbody slot="body" slot-scope="{ data }">
        <div class="card-deck">
          <div class="card mb-4" :key="item.id" v-for="item in data">
            <div>
              <img
                v-bind:src="'/storage/assets/productos-img/' + item.imagen"
                alt="Card image cap"
                class="card-img-top"
              />
              <div class="card-body">
                <h4 class="card-title">
                  {{ item.nombre }}
                </h4>
                <p class="card-text">{{ item.precio }} {{ item.unidad }}</p>
                <p class="card-text">{{ item.categoria }}</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">
                  <div
                    class="btn btn-primary btn-sm btn-block"
                    data-toggle="modal"
                    @click="abrirModal(item)"
                    data-target="#modal"
                  >
                    AÑADIR <i class="fas fa-cart-arrow-down"></i>
                  </div>
                </small>
              </div>
            </div>
          </div>
        </div>
      </tbody>
    </data-table>

    <!-- Modal -->
    <div
      class="modal fade"
      id="modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modal"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content form-group">
          <form class="needs-validation" id="form" v-on:submit.prevent>
            <!-- Modal Head -->
            <div class="modal-header bg-primary bg-gradient">
              <h5 class="modal-title" id="modal">
                {{ producto.nombre + " - " + producto.categoria }}
              </h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
              <table>
                <tr>
                  <td id="td_img">
                    <img
                      v-bind:src="
                        '/storage/assets/productos-img/' + producto.imagen
                      "
                      alt="Card image cap"
                      width="200"
                    />
                  </td>
                  <td>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text col-md">PRECIO</span>
                      </div>
                      <span class="input-group-text col-md"
                        >${{ producto.precio + " * " + producto.unidad }}</span
                      >
                    </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="cantidad"
                          >CANTIDAD</span
                        >
                      </div>
                      <input
                        type="number"
                        class="form-control"
                        placeholder="cantidad"
                        aria-label="cantidad"
                        aria-describedby="cantidad"
                        v-model="cantidad"
                        min="1"
                        required
                      />
                    </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text col-md">SUBTOTAL</span>
                      </div>
                      <span class="input-group-text col-md"
                        >${{ producto.precio * cantidad }}</span
                      >
                    </div>
                  </td>
                </tr>
              </table>
            </div>
            <!-- Moda Footer -->
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
                @click="addCart(producto)"
              >
                Añadir al carro <i class="fas fa-cart-arrow-down"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      productos: {},
      producto: {
        id: "",
        nombre: "",
        precio: "",
        unidad: "",
        categoria: "",
        imagen: null,
      },
      cantidad: 0,
      categorias: [
        "Todos",
        "Fruta",
        "Verdura",
        "Pulpas",
        "Arepas",
        "Huevos",
        "Lacteos",
        "Otros",
        "Carne",
        "Cerdo",
        "Pollo",
        "Pescado",
        "Viceras",
      ],
      // Data Table
      filters: {
        isActive: true,
      },
      tableProps: {
        search: "",
        length: 30,
        column: "categoria",
        dir: "asc",
      },
      perpage: ["30", "60", "100"],
      data: {},
      columns: [
        {
          label: "",
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
    };
  },
  methods: {
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
    abrirModal(entry) {
      this.cantidad = 1;
      this.producto.id = entry.id;
      this.producto.nombre = entry.nombre;
      this.producto.precio = entry.precio;
      this.producto.unidad = entry.unidad;
      this.producto.categoria = entry.categoria;
      this.producto.imagen = entry.imagen;
    },
    async addCart(producto) {
      if (this.validate()) {
        let formData = new FormData();
        formData.append("id", producto.id);
        formData.append("nombre", producto.nombre);
        formData.append("precio", producto.precio);
        formData.append("cantidad", this.cantidad);
        const res = await axios.post("/cart/add", formData, {});
        $("#modal").modal("hide");
        if (res) {
          this.$swal.fire("Producto añadido", "", "success");
          this.$root.$emit("checkCart");
          //this.reloadTable();
        } else {
          this.$swal.fire("Error, el producto no fue añadido", "", "error");
          //this.reloadTable();
        }
      }
    },
    validate() {
      var validate = true;
      if (this.cantidad < 1) {
        validate = false;
      }
      return validate;
    },
  },
  created() {
    //this.reloadTable();
  },
};
</script>

<style>
body {
  padding-top: 20px;
}

.card-deck {
  margin: 0 -15px;
  justify-content: space-between;
}

.card-deck .card {
  margin: 0 0 1rem;
}

@media (min-width: 576px) and (max-width: 767.98px) {
  .card-deck .card {
    -ms-flex: 0 0 48.7%;
    flex: 0 0 48.7%;
  }
}

@media (min-width: 768px) and (max-width: 991.98px) {
  .card-deck .card {
    -ms-flex: 0 0 32%;
    flex: 0 0 32%;
  }
}

@media (min-width: 992px) {
  .card-deck .card {
    -ms-flex: 0 0 24%;
    flex: 0 0 24%;
  }
}

#td_img img {
  vertical-align: bottom;
}
</style>
