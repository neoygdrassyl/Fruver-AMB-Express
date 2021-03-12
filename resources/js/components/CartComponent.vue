<template>
  <div>
    
    <!-- Div for NO Items in the Cart -->  
    <div v-if="!show" class="row justify-content-md-center">
       <div class="card text-center mt-4 mb-4">
        <div class="card-body">
          <h5 class="card-title">El carrito de compras se encuentra vacio.</h5>
          <p class="card-text">
           No te preocupes, puede seguir a la tienda y agregar productos al carrito de compras de forma facil y rapida.
          </p>
          <a href="/tienda" class="btn btn-primary">Seguir a la tienda</a>
        </div>
      </div>
    </div>
    <!-- Div for Items in the Cart -->  

    <div v-if="show" class="row justify-content-md-center">

    <!-- Part 0 Progress Bar -->

    <div class="col-10 col-center mb-3 mt-3">
      <div class="card text-center text-dark bg-light">
        <div class="card-header">
          <p class="fs-4 fw-bold">FINALIZAR COMPRA</p>
        </div>
        <div class="card-body">
          <div class="progress">
            <div
              class="progress-bar progress-bar-striped progress-bar-animated"
              id="progress"
              role="progressbar"
              aria-valuenow="25"
              aria-valuemin="0"
              aria-valuemax="100"
              style="width: 25%"
            ></div>
          </div>
        </div>
        <div class="card-footer text-muted">
          <p v-if="state == 1">Paso 1: Revision del carrito de compras</p>
          <p v-if="state == 2">Paso 2: Datos del cliente</p>
          <p v-if="state == 3">Paso 3: Costos de envio y confirmacion</p>
          <p v-if="state == 4">
            Paso 4: Compra realizada! revisa tu correo de contacto para
            confirmar el pedido
          </p>
        </div>
      </div>
    </div>

    <!-- Part 1 Cart and Subtotal -->

    <transition name="fade">
      <table class="table table-hover table-responsive-md" v-if="state == 1">
        <thead class="table-primary">
          <tr>
            <th scope="col" colspan="2" class="text-center">Producto</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Total</th>
            <th scope="col">Accion</th>
          </tr>
        </thead>
        <tbody>
          <tr :key="producto.id" v-for="producto in productos">
            <th scope="row">
              <img
                v-bind:src="'/storage/assets/productos-img/' + producto.imagen"
                width="100"
                alt="Loading..."
              />
            </th>
            <td>{{ producto.nombre }}</td>
            <td>${{ producto.precio }} * {{ producto.unidad }}</td>
            <td>
              <input
                type="number"
                class="form-control"
                placeholder="cantidad"
                aria-label="cantidad"
                aria-describedby="cantidad"
                v-model="producto.cantidad"
                min="1"
                v-on:change="addQuantity(producto.id, producto.cantidad)"
                required
              />
            </td>
            <td>${{ producto.precio * producto.cantidad }}</td>
            <td>
              <a v-on:click="removeProduct(producto.id)"
                ><span style="color: Tomato"
                  ><i class="far fa-times-circle fa-2x"></i></span
              ></a>
            </td>
          </tr>
        </tbody>
        <tfoot class="table-active">
          <tr>
            <td colspan="4" class="text-right">
              <p class="fs-4 fw-bold">SUBTOTAL</p>
            </td>
            <td>
              <p class="fs-4 fw-bold">${{ subtotal }}</p>
            </td>
            <td>
              <button class="btn btn-primary" v-on:click="transition(1)">
                Continuar
              </button>
            </td>
          </tr>
        </tfoot>
      </table>
    </transition>

    <div class="container row mb-2">
      <!-- Part 2 Client Info-->

      <transition name="fade">
        <form
          v-if="state == 2"
          class="needs-validation col-6"
          id="form"
          v-on:submit.prevent
        >
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nombre">Nombre</label>
              <input
                type="text"
                class="form-control"
                id="nombre"
                placeholder="Nombre"
                required
                v-model="envio.nombre"
              />
            </div>
            <div class="form-group col-md-6">
              <label for="apellido">Apellido</label>
              <input
                type="text"
                class="form-control"
                id="apellido"
                placeholder="Apellido"
                v-model="envio.apellido"
                required
              />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="telefono">Telefono de contacto</label>
              <input
                type="text"
                class="form-control"
                id="telefono"
                placeholder="Telefono o Celular"
                v-model="envio.telefono"
                required
              />
            </div>
            <div class="form-group col-md-6">
              <label for="email">Correo de contacto</label>
              <input
                type="email"
                class="form-control"
                id="correo"
                placeholder="Correo electronico"
                v-model="envio.correo"
                required
              />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="direccion">Direccion</label>
              <input
                type="text"
                class="form-control"
                placeholder="Direccion"
                id="direccion"
                v-model="envio.direccion"
                required
              />
            </div>
            <div class="form-group col-md-6">
              <label for="ciudad">Ciudad</label>
              <select
                id="ciudad"
                class="form-control"
                v-model="envio.ciudad"
                required
              >
                <option selected>Bucaramanga</option>
                <option>Floridablanca</option>
                <option>Giron</option>
                <option>Piedecuesta</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="anotaciones">Anotaciones y detalles</label>
              <textarea
                class="form-control"
                id="anotaciones"
                rows="5"
                v-model="envio.anotaciones"
                placeholder="Informacion adicionel del pedido (Opcional)"
              ></textarea>
            </div>
          </div>
          <button class="btn btn-secondary" v-on:click="transition(-1)">
            Regresar
          </button>
          <button
            type="submit"
            class="btn btn-primary"
            v-on:click="transition(1)"
          >
            Continuar
          </button>
        </form>
      </transition>

      <!-- Part 3 Send Cost and Tax -->

      <transition name="fade">
        <div class="col-sm-6 mb-2" v-if="state == 3">
          <div class="card mb-2">
            <div class="card-body">
              <h5 class="card-title">Costo de envio</h5>
              <h6 class="card-subtitle mb-2 text-muted">${{ costoEnvio }}</h6>
              <p class="card-text">
                La tarifa base costo de envio es $4000(COP). La tarifa de costo de envio cambia basado en el subtotal de la Orden de Envio y la ciudad destino.
              </p>
              <p>Para Bucaramanga la tarifa es de $0(COP) para ordenes mayores a $20000(COP)</p>
              <p>Para Floridablanca la tarifa es de $0(COP) para ordenes mayores a $15000(COP)</p>
              <p>Para Giron y Piedecuesta la tarifa es de $0(COP) para ordenes mayores a $30000(COP)</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
              <h5 class="card-title">Informacio de Datos del Cliente</h5>
              <p>Nombre de solicitante: {{envio.nombre}} {{envio.apellido}}</p>
              <p>Telefono de Contacto: {{envio.telefono}}</p>
              <p>Correo de contacto: {{envio.correo}}</p> 
              <p>Direccion de envio: {{envio.direccion}}, {{envio.ciudad}}</p>
              </li></ul>
          </div>
          <button class="btn btn-secondary" v-on:click="transition(-1)">
            Regresar
          </button>
          <button
            type="submit"
            class="btn btn-primary"
            v-on:click="transition(1)"
          >
            Realizar Compra
          </button>
        </div>
      </transition>

      <!-- Part 0 Reiew of the Shopping Cart -->

      <transition name="fade">
        <table class="table col-6 table-sm" v-if="state >= 2 && state <= 3">
          <thead class="table-primary">
            <tr>
              <th scope="col" colspan="2" class="text-center">Tu Pedido</th>
            </tr>
          </thead>
          <tbody>
            <tr :key="producto.id" v-for="producto in productos">
              <th scope="row">
                <img
                  v-bind:src="
                    '/storage/assets/productos-img/' + producto.imagen
                  "
                  width="100"
                  alt="Loding..."
                />
              </th>
              <td>
                <p>
                  {{ producto.nombre }} ${{ producto.precio }}
                  {{ producto.unidad }}
                </p>
                <p>
                  {{ producto.cantidad }} {{ producto.unidad }} ${{
                    producto.precio * producto.cantidad
                  }}
                </p>
              </td>
            </tr>
          </tbody>
          <tfoot class="table-active">
            <tr>
              <td class="text-right">
                <p class="fs-4 fw-bold">SUBTOTAL</p>
              </td>
              <td>
                <p class="fs-4 fw-bold">${{ subtotal }}</p>
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <p class="fs-4 fw-bold">ENVIO</p>
              </td>
              <td>
                <p class="fs-4 fw-bold">${{ costoEnvio }}</p>
              </td>
            </tr>
            <tr>
              <td class="text-right">
                <p class="fs-4 fw-bold">TOTAL</p>
              </td>
              <td>
                <p class="fs-4 fw-bold">${{ total }}</p>
              </td>
            </tr>
          </tfoot>
        </table>
      </transition>
    </div>

    <!-- Part 4 Order Done -->

    <transition name="fade">
      <div class="card text-center mb-3" v-if="state == 4">
        <div class="card-body">
          <h5 class="card-title">¡Orden de envio realizada correctamente!</h5>
          <p class="card-text">
            La orden a sido enviada a nuestros distribuidor que en pocos
            momentos asistira tu pedido.
          </p>
          <a href="/tienda" class="btn btn-primary">Regresar a la tienda</a>
        </div>
        <div class="card-footer text-muted">
          Revisa tu correo de contacto para verificar la verificar la order de
          envio.
        </div>
      </div>
    </transition>
  </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cart: { content: {}, quantity: 0, subtotal: 0 },
      productos: {},
      sum: 0,
      state: 1,
      progress: 25,
      envio: {
        nombre: "",
        apellido: "",
        telefono: "",
        correo: "",
        direccion: "",
        ciudad: "",
        anotaciones: "",
      },
      costoEnvio: 4000,
      subtotal: 0,
      total: 0,
      show: false
    };
  },
  methods: {
    transition(value) {
      this.validateCostoEnvio();
      if (this.state == 2 && value == 1) {
        if (this.validate()) {
          this.total = this.costoEnvio + this.sum;
          this.state += value;
        }
      } else if (this.state == 3 && value == 1) {
        this.makeOrder();
      } else {
        this.state += value;
      }
      this.progress = 25 * this.state;
      $(".progress-bar").css("width", this.progress + "%");
    },
    checkEmptyCart() {
      if (Object.keys(this.cart.content).length > 0){
        this.show = true;
      }else if(this.state == 4){
        this.show = true;
      }else{
        this.show = false;
      }
    },
    async checkCart() {
      const res = await axios.get("/cart/info");
      this.cart = res.data;
      this.checkEmptyCart();
      this.loadContent();
    },
    async loadContent() {
      const res = await axios.post("/cart/total", this.cart);
      this.productos = res.data;
      this.cambioCantidad();
    },
    cambioCantidad() {
      this.sum = 0;
      this.productos.forEach((element) => {
        this.sum += element.cantidad * element.precio;
      });
      this.subtotal = this.sum;
    },
    removeProduct(id) {
      this.$swal({
        title: "¿Esta seguro de remover este Producto del carrito de compras?",
        text: "El item podra ser añadido de nuevo mas tarde.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Remover",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          this.delete(id);
        }
      });
    },
    async delete(id) {
      const res = await axios.get("/cart/remove/" + id);
      if (res) {
        this.$swal.fire("Producto removido", "", "success");
      } else {
        this.$swal.fire("Error, el producto no se removio", "", "error");
      }
      this.checkCart();
      this.$root.$emit("checkCart");
    },
    async clearCart() {
      const res = await axios.get("cart/clear");
      if (res) {
        this.$swal.fire("¡Order de Envio realizada!", "La orden ha sido enviada a nuestros distribuidores quienes realizaran el pedido en cuanto sea posible, revise su correo de contacto para verificar su orden de envio, si no llega en pocos momentos, revise su bandeja de SPAM.", "success");
      } else {
        this.$swal.fire("Un error ah ocurrido", "", "error");
      }
      this.checkCart();
      this.$root.$emit("checkCart");
    },
    async addQuantity(id, cantidad) {
      let formData = new FormData();
      formData.append("id", id);
      formData.append("quantity", cantidad);
      const res = await axios.post("/cart/addq", formData, {});
      if (res) {
        this.checkCart();
        this.$root.$emit("checkCart");
      }
    },
    async makeOrder() {
      this.sendMail();
    },
    async sendMail(){
      let formData = new FormData();
      formData.append("subtotal", this.sum);
      formData.append("content", JSON.stringify(this.productos));
      formData.append("client", JSON.stringify(this.envio));
      formData.append("sendCost", this.costoEnvio);
      const res = await axios.post("/cart/make", formData, {});
      this.state++;
      this.progress = 25 * this.state;
      $(".progress-bar").css("width", this.progress + "%");
      this.createOrder();
    },
    async createOrder(){
      let formData = new FormData();
      formData.append("subtotal", this.subtotal);
      formData.append("total", this.total);
      const res = await axios.post("/admin/orders", formData, {});
      if(res){
        this.createShipping();
      }
    },
    async createShipping() {
        let formData = new FormData();
        formData.append("productos", JSON.stringify(this.productos));
        const res = await axios.post("/shippings", formData, {}); 
        if(res){
          this.clearCart();
        }
    },
    validate() {
      var validate = true;
      if (this.envio.nombre == "") {
        validate = false;
      }
      if (this.envio.apellido == "") {
        validate = false;
      }
      if (this.envio.telefono == "") {
        validate = false;
      }
      if (this.envio.correo == "") {
        validate = false;
      }
      if (this.envio.direccion == "") {
        validate = false;
      }
      if (this.envio.ciudad == "") {
        validate = false;
      }
      //if ((this.envio.anotaciones == "")) {
      //validate = false;
      //}
      return validate;
    },
    validateCostoEnvio() {
      // Bucaramanga > 20
      // Florida > 15
      // Gil, Piede > 30
      // Base 4000
      if(this.envio.ciudad == 'Bucaramanga' && this.subtotal > 20000){this.costoEnvio = 0}
      else if(this.envio.ciudad == 'Floridablanca' && this.subtotal > 15000){this.costoEnvio = 0}
      else if(this.envio.ciudad == 'Giron' && this.subtotal > 30000){this.costoEnvio = 0}
      else if(this.envio.ciudad == 'Piedecuesta' && this.subtotal > 30000){this.costoEnvio = 0}
      else{
        this.costoEnvio = 4000;
      }
    },
  },
  created() {
    this.checkCart();
  },
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>