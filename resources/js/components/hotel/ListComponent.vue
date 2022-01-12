<template>
  <div>

    <div v-if="hoteles.length == 0" class="d-flex gap-3 justify-content-center align-items-center">
      <div class="spinner-border text-secondary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <span class="text-muted">Buscando hoteles</span>
    </div>

    <div v-if="provincia.length > 0">
      <h4>Hoteles de '{{ provincia }}'</h4>
      <p class="text-muted">{{ filteredHoteles.length }} hoteles encontrados</p>
    </div>

    <div v-if="hoteles.length > 0" class="mb-5">
      <input id="filtro-nombre" type="text" class="form-control">
      <div class="d-flex gap-3 mt-3">
        <select id="filtro-provincia" class="form-select">
          <option value="bizkaia">Bizkaia</option>
          <option value="gipuzkoa">Gipuzkoa</option>
          <option value="araba">Araba</option>
        </select>
        <select id="filtro-tipo" class="form-select">
          <option value="bizkaia">Bizkaia</option>
          <option value="gipuzkoa">Gipuzkoa</option>
          <option value="araba">Araba</option>
        </select>
      </div>
    </div>

    <div class="hoteles">
      <div v-for="(hotel, index) in filteredHoteles" v-bind:key="index" class="hotel shadow-sm">
        <div class="d-flex justify-content-between">
          <span class="title"><a v-bind:href="'/hoteles/' + hotel.id">{{ hotel.documentName }}</a></span>
          <i class="fa fa-heart fs-4 text-secondary"></i>
        </div>
        <span class="text-muted d-block mb-2">{{ hotel.municipality }}, {{ hotel.territory }},
          {{ hotel.country }}
        </span>
        <p v-html="hotel.turismDescription"></p>
      </div>
    </div>

  </div>

</template>

<script>

export default {

  mounted() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("provincia"))
      this.provincia = urlParams.get("provincia").toLowerCase();
    this.getHoteles();
  },

  data: () => ({
    title: "Hoteles de euskadi",
    hoteles: [],
    likes: [],
    provincia: ""
  }),

  computed: {

    filteredHoteles() {
      if (this.provincia.length > 0) {
        return this.hoteles.filter(hotel => {
          return hotel.municipality.toLowerCase().includes(this.provincia)
            || hotel.locality.toLowerCase().includes(this.provincia)
            || hotel.territory.toLowerCase().includes(this.provincia);
        });
      } else {
        return this.hoteles;
      }
    }

  },

  methods: {

    getHoteles() {
      const URL = "https://opendata.euskadi.eus/contenidos/ds_recursos_turisticos/hoteles_de_euskadi/opendata/alojamientos.json";
      axios.get(URL).then((response) => {
        let data = new String(response.data).replace("jsonCallback(", "").replace(");", "");
        this.hoteles = JSON.parse(data); 
        for (let i = 0; i < this.hoteles.length; i++) {
          this.hoteles[i].id = i;
        }
      });
    }

  }

};

</script>
