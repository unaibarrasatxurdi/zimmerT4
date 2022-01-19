<template>
  <div class="container">

    <h1>Fav {{ this.fav }}</h1>

    <div v-if="hotel == null" class="d-flex gap-3 justify-content-center align-items-center">
      <div class="spinner-border text-secondary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <span class="text-muted">Cargando datos del hotel</span>
    </div>

    <div v-else class="hotel d-flex gap-5">
      <div class="d-flex flex-column gap-3 align-items-center">
         <div>
          <span v-if="hotel.lodgingType==='Hoteles'">  
          <img :src="'/img/hotel.jpg'" style="max-width: 25rem !important;">
          </span>
          <span v-if="hotel.lodgingType==='Pensiones'">
            <img :src="'/img/pennsion.jpg'" style="max-width: 25rem !important;">
          </span>
          <span v-if="hotel.lodgingType==='Apartamentos'">
            <img :src="'/img/APARTAMENTO.jpg'" style="max-width: 25rem !important;">
          </span>
          <span v-if="hotel.lodgingType==='Hotel-Apartamento'">
            <img :src="'/img/apartahotel.jpg'" style="max-width: 25rem !important;">
          </span>
        </div>
        <iframe v-bind:src="'https://maps.google.com/?q='+hotel.latwgs84+','+hotel.lonwgs84+'&output=embed'" style="width: 25rem; border:0;" allowfullscreen="" loading="lazy" class="m-0 p-0"></iframe>
      </div>
      <div>
        <div class="d-flex justify-content-between">
          <span class="title">{{ hotel.documentName }}</span>
          <i v-if="fav" v-on:click="like($event, hotel.id, user_id)" class="fa fa-heart fs-4 text-danger"></i>
          <i v-else v-on:click="like($event, hotel.id, user_id)" class="fa fa-heart fs-4 text-secondary"></i>
        </div>
        <span class="text-muted d-block mb-2">
          {{ hotel.municipality }}, {{ hotel.territory }}
        </span>
        <span v-if="hotel.address.length" class="text-muted d-block mb-2">
          {{ hotel.address }}
        </span>
        
        <span class="text-muted d-block mb-2">
          <div id="map_canvas"></div>
        </span>
        
        <p v-html="hotel.turismDescription"></p>
        <div v-if="hotel.web" class="d-flex align-items-center gap-2 mb-2">
          <i class="fa fa-globe text-muted fs-5"></i>
          <a v-bind:href="hotel.web">Pagina web</a>
        </div>
        <div v-if="hotel.tourismEmail" class="d-flex align-items-center gap-2">
          <i class="fa fa-envelope text-muted fs-5"></i>
          <a v-bind:href="'mailto:' + hotel.tourismEmail">Correo electronico</a>
        </div>  
      </div>
    </div>

  </div>

</template>

<script>

  export default {

    mounted() {
      this.getHotel();
    },

    props: ["id", "user_id", "fav"],

    data: () => ({
      hotel: null,
      likes: [],
      destination: ""
    }),

    computed: {

      filteredHoteles() {
        if (this.destination.length > 0) {
          return this.hoteles.filter(hotel => {
            return hotel.municipality.toLowerCase().includes(this.destination)
              || hotel.locality.toLowerCase().includes(this.destination)
              || hotel.territory.toLowerCase().includes(this.destination);
          });
        } else {
          return this.hoteles;
        }
      }
      
    },

    methods: {

      getHotel() {
        const URL = "https://opendata.euskadi.eus/contenidos/ds_recursos_turisticos/hoteles_de_euskadi/opendata/alojamientos.json";
        axios.get(URL).then((response) => {
          let data = new String(response.data).replace("jsonCallback(", "").replace(");", "");
          this.hotel = JSON.parse(data)[this.id];
          this.hotel.id = this.id;
        });
      },

      like(event, hotel_id, user_id) {
        if (event.target.classList.contains("text-secondary")) {
          event.target.classList.remove("text-secondary");
          event.target.classList.add("text-danger");
          console.log(user_id + " liked " + hotel_id);
          $.ajax({
            type: "POST",
            url: "/gogokoa",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { hotel_id: hotel_id, user_id, user_id },
            success: data => console.log(data.msg),
            error: data => console.log(data.msg)
          });
        } else if (event.target.classList.contains("text-danger")) {
          event.target.classList.remove("text-danger");
          event.target.classList.add("text-secondary");
          console.log(user_id + " unliked " + hotel_id);
          $.ajax({
            type: "DELETE",
            url: "/gogokoa",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { hotel_id: hotel_id, user_id, user_id },
            success: data => console.log(data.msg),
            error: data => console.log(data.msg)
          });
        }
      }

    }

  };

</script>
