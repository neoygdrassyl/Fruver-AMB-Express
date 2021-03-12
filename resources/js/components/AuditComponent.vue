<template>
  <div class="container">
    <!-- Data Table -->

    <data-table
      :columns="columns"
      url="/audit"
      :classes="classes"
      :per-page="perpage"
      :translate="translate"
    >
      <!-- Filters -->
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
                name="table-search"
                class="form-control"
                v-model="tableFilters.search"
                placeholder="Buscar Auditoria"
              />
            </div>
          </div>
        </div>
      </div>

      <!-- Body -->

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
              {{ moment(item.created_at).format("LLL") }}
            </slot>
          </td>
        </tr>
      </tbody>
    </data-table>
  </div>
</template>
<script>
var moment = require("moment");
moment.locale("es");
export default {
  data() {
    return {
      // Data Table
      moment: moment,
      data: "",
      perpage: ["20", "50", "100"],
      columns: [
        {
          label: "ID",
          name: "id",
          orderable: true,
        },
        {
          label: "Usuario",
          name: "user",
          orderable: true,
        },
        {
          label: "Modulo",
          name: "table",
          orderable: true,
        },
        {
          label: "Accion",
          name: "action",
          orderable: true,
        },
        {
          label: "Fecha",
          orderable: true,
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
        length: 20,
        column: "id",
        dir: "asc",
      },
    };
  },
  // Methods
  methods: {
    this_method() {
      console.log("Hellow world!");
    },
  },
  // End Methods
  created() {
    this_method();
  },
};
</script>