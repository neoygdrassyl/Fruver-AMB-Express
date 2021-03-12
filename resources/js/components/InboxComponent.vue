<template>
  <div class="container">
    <div class="text-center">
      <h2 class="section-heading text-uppercase">Conéctate con nosotros</h2>
      <h3 class="section-subheading text-white">
        Conocer la opinión de nuestros clientes es muy importante para nosotros,
        extendemos la invitación a llenar nuestro formulario para solicitar
        información sobre los productos y servicios que ofrecemos. A la brevedad
        posible, uno de nuestros representantes atenderá la solicitud.
      </h3>
    </div>
    <form
      id="contactForm"
      name="sentMessage"
      class="needs-validation"
      novalidate
      v-on:submit.prevent
    >
      <div class="row align-items-stretch mb-5">
        <div class="col-md-6">
          <div class="form-group">
            <input
              class="form-control"
              id="name"
              type="text"
              placeholder="Tu Nombre *"
              required
              v-model="inbox.name"
              aria-required="Este campo es obligatorio"
            />
            <p class="help-block text-danger"></p>
          </div>
          <div class="form-group">
            <input
              class="form-control"
              id="email"
              type="email"
              placeholder="Tu email *"
              required
              v-model="inbox.email"
            />
            <p class="help-block text-danger"></p>
          </div>
          <div class="form-group mb-md-0">
            <input
              class="form-control"
              id="phone"
              type="text"
              placeholder="Tu numero de contaco *"
              required
              v-model="inbox.phone"
            />
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group form-group-textarea mb-md-0">
            <textarea
              class="form-control"
              id="message"
              placeholder="Tu mensaje *"
              required
              v-model="inbox.message"
            ></textarea>
            <p class="help-block text-danger"></p>
          </div>
        </div>
      </div>
      <div class="text-center">
        <div id="success"></div>
        <button
          class="btn btn-primary btn-xl text-uppercase"
          id="sendMessageButton"
          type="submit"
          v-on:click="send()"
        >
          Enviar Mensaje
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      inbox: {
        name: "",
        email: "",
        phone: "",
        message: "",
      },
    };
  },
  // Methods
  methods: {
    async send() {
      if (this.validate()) {
        let formData = new FormData();
        formData.append("inbox", JSON.stringify(this.inbox));
        const res = await axios.post("/inbox", formData, {});
          this.$swal.fire(
            "Su mensaje ha sido enviado!",
            "En estos moments el mensaje se esta procesando.\nEstaremos atentos al mensaje enviado, gracias por particiar.",
            "success"
          );
      } else {
        this.$swal.fire({
          title: "Datos incompletos",
          icon: "error",
        });
      }
    },
    validate() {
      var validate = true;
      if (this.inbox.name == "") {
        validate = false;
      }
      if (this.inbox.phone == "") {
        validate = false;
      }
      if (this.inbox.email == "") {
        validate = false;
      }
      if (this.inbox.message == "") {
        validate = false;
      }
      return validate;
    },
  },
  // End Methods
  created() {
    // Hello world!
  },
};
</script>