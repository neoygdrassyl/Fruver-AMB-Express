<template>
  <div class="">
    <data-table
      :columns="columns"
      url = "/admin/orders"
      :classes="classes"
      :per-page="perpage"
      :translate="translate"
      @finished-loading="addTotal"
    >
      <div
        slot="filters"
        slot-scope="{ tableFilters, perPage }"
        class="card bg-light border-primary mt-5"
      >
        <div class="row card-body">
          <div class="col-4">
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
          <div class="col-8">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="table-search"
                  ><i class="fas fa-search"></i
                ></label>
              </div>
              <input
                id="table-search"
                name="table-search"
                class="form-control"
                v-model="tableFilters.search"
                placeholder="Buscar Orden de Envio"
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
            <slot v-if="column.label == 'Fecha'">
              {{ moment(item.created_at).format("LL") }}
            </slot>
            <slot v-if="column.label == 'Accion'">
              <div
                class="btn btn-info"
                data-toggle="modal"
                @click="abrirModal(item)"
                data-target="#modal"
              >
                <a> <i class="far fa-eye"></i></a>
              </div>
            </slot>
          </td>
        </tr>
        <tr class="table-active">
          <td colspan="2" class="text-right">
            <p class="fs-4 fw-bold">TOTAL</p>
          </td>
          <td colspan="3">
            <p class="fs-4 fw-bold">${{ sum }}</p>
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
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content form-group">
          <div class="modal-header bg-primary bg-gradient">
            <h5 class="modal-title" id="modal">
              Orden de venta #{{ tituloModal }}
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
          <div class="modal-body">
            <table class="table table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>Producto</th>
                  <th>Categoria</th>
                  <th>Cantidad</th>
                  <th>Unidad</th>
                  <th>Precio(Unidad)</th>
                  <th>Precio(Total)</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in items" v-bind:key="item.nombre">
                  <td>{{ item.nombre }}</td>
                  <td>{{ item.categoria }}</td>
                  <td>{{ item.quantity }}</td>
                  <td>{{ item.unidad }}</td>
                  <td>{{ item.precio }}</td>
                  <td>{{ item.precio * item.quantity }}</td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="5" class="text-right">Subtotal</th>
                  <th>{{ order.subtotal }}</th>
                </tr>
                <tr class="table-secondary">
                  <th colspan="5" class="text-right">Total</th>
                  <th>{{ order.total }}</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- End Modal -->
  </div>
</template>
<script>
var moment = require("moment");
moment.locale("es");
export default {
  data() {
    return {
      tituloModal: "",
      items: [],
      order: "",
      //Data Table
      moment: moment,
      sum: 0,
      data: {},
      perpage: ["10", "25", "50"],
      table: {},
      columns: [
        {
          label: "Order #",
          name: "order_public_id",
          orderable: true,
        },
        {
          label: "Subtotal",
          name: "subtotal",
          orderable: false,
        },
        {
          label: "Total",
          name: "total",
          orderable: false,
        },
        {
          label: "Fecha",
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
        placeholderSearch: "Buscar Orden de Envio",
      },
      tableProps: {
        search: "",
        length: 10,
        column: "order_public_id",
        dir: "asc",
      },
    };
  },
  // Methods
  methods: {
    async reloadTable(url = "/admin/orders", options = this.tableProps) {
      axios
        .get(url, {
          params: options,
        })
        .then((response) => {
          var val = 0;
          response.data.data.forEach(function(element) {
            val += parseInt(element.total);
          })
          this.sum = val;
        })
        .catch((errors) => {});
    },
    async addTotal() {
      var searchStr = $('#table-search').val();
      var lengthR =  $('#selectR').val();
        this.tableProps = {
          search: searchStr,
          length: lengthR,
          column: "order_public_id",
          dir: "asc",
        };
      this.reloadTable("/admin/orders", this.tableProps);
    },
    async loadItems(id) {
      const res = await axios.get("/shippings/" + id);
      if (res) {
        this.items = res.data;
      }
    },
    abrirModal(entry = null) {
      if (entry) {
        this.order = entry;
        this.tituloModal = entry.order_public_id;
        this.loadItems(entry.id);
      }
    },
  },
  // End Methods
  created() {
    this.addTotal();
  },
};
</script>