<template>
  <div class="container">
        </div>
</template>
<script>
export default {
  data() {
    return {
        data: '',
    };
  },
  // Methods
  methods: {
    this_method() {
        console.log('Hellow world!');
    },
  },
  // End Methods
  created() {
    this_method();
  },
};
</script>