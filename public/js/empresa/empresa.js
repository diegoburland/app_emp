const app = new Vue({
  el:'#form_empresa',
  data:{
    errors:[],
    razon_social:null,
    ubicacion:null
  },
  methods:{
    checkForm:function(e) {
      if(this.razon_social && this.ubicacion) return true;
      this.errors = [];
      if(!this.razon_social) this.errors.push("Nombre de la empresa requerido.");
      if(!this.ubicacion) this.errors.push("Ubicacion requerida.");
      e.preventDefault();
    }
  }
})