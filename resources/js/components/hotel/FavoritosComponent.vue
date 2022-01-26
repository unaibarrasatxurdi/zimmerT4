<template>
    <div>

      <div v-if="hoteles.length == 0" class="d-flex gap-3 justify-content-center align-items-center" >
        <div class="spinner-border text-secondary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <span class="text-muted">Buscando hoteles</span>
      </div>

    <div class="mb-4">
        <h4>Zure hotel gogokoenak</h4>
    </div>

     <div class="hoteles" id="hoteles">
      <div v-for="(hotel, index) in irazkiHotelak" v-bind:key="index" >
        <div v-if="favsContains(hotel.id)" class="hotel shadow-sm d-flex gap-4 align-items-center">
          <div class="w-100">
            <div class="d-flex justify-content-between">
              <span class="title">
                <a v-bind:href="'/hoteles/' + hotel.id">{{ hotel.documentName }}</a>
              </span>
              <i v-if="favsContains(hotel.id)" v-on:click="like($event, hotel.id, user_id)" class="fa fa-heart fs-4 text-danger"></i>
              <i v-else v-on:click="like($event, hotel.id, user_id)" class="fa fa-heart fs-4 text-secondary"></i>
            </div>
            <span class="text-muted fw-normal">{{ hotel.lodgingType }}</span>
            <span class="text-muted d-block mb-2">
              {{ hotel.municipality }}, {{ hotel.territory }}, {{ hotel.country }}
            </span>
            <p v-html="truncate(removeHTML(hotel.turismDescription))"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {


    var favs_json = JSON.parse(this.favs);
    for(let i = 0; i < favs_json.length; i++) {
      this.favHoteles.push(favs_json[i]["hotel_id"]);
    }
    
    this.getHoteles();
  },

  data: () => ({
    title: "Hoteles de euskadi",
    hoteles: [],
    likes: [],
    probintzia: "",
    sartutakoIzena: "",
    sartutakoOstatzeMota: "",
    hoteles: [],
    ostatzeMotak: [],
    favHoteles: []
  }),

    props: ["favs", "user_id"],

  computed: {
    ostatzeak() {
      return this.ostatzeMotak;
    },
  },

  methods: {
    truncate(descripcion) {
      if (descripcion.length > 100) {
        return descripcion.substring(0, 100) + "...";
      } else {
        return descripcion;
      }
    },
    
     favsContains(hotel_id) {
      let result = this.favHoteles.includes(hotel_id);
      // console.log(result, hotel_id);
      return result;
    },
    favsContains(hotel_id) {
      let result = this.favHoteles.includes(hotel_id);
      return result;
    }
  },
};
</script>