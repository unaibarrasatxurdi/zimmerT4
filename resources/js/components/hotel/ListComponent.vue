<template>
  <div>
    <div
      v-if="hoteles.length == 0"
      class="d-flex gap-3 justify-content-center align-items-center"
    >
      <div class="spinner-border text-secondary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <span class="text-muted">Buscando hoteles</span>
    </div>

    <div>
      <div v-if="hoteles.length > 0">
        <div v-if="probintzia.length > 0">
          <h4>'{{ probintzia }}'-ko hotelak</h4>
          <p class="text-muted">{{ irazkiHotelak.length }} hotel aurkituta</p>
        </div>
        <div v-else>
          <h4>Euskadiko hotelak</h4>
          <p class="text-muted">{{ irazkiHotelak.length }} hotel aurkituta</p>
        </div>
      </div>
    </div>

    <div v-if="hoteles.length > 0" class="mb-5">
      <!-- probintzia sartutakoIzena - bilatuIzenarenArabera funtzioak erabiltzen du -->
      <input
        v-model="sartutakoIzena"
        id="filtro-nombre"
        type="text"
        class="form-control"
        placeholder="Bilatu hotelak"
      />
      <div class="d-flex gap-3 mt-3">
        <!-- probintzia aldagaia - bilatuProbintziarenArabera funtzioak erabiltzen du -->
        <select v-model="probintzia" id="filtro-probintzia" class="form-select">
          <option default selected hidden value="">Aukeratu probintzia</option>
          <option value="bizkaia">Bizkaia</option>
          <option value="gipuzkoa">Gipuzkoa</option>
          <option value="araba">Araba</option>
        </select>

        <!-- probintzia sartutakoOstatzeMota - bilatuOstatzeMotarenArabera funtzioak erabiltzen du -->
        <select
          v-model="sartutakoOstatzeMota"
          id="filtro-tipo"
          class="form-select"
        >
          <option default selected hidden value="">
            Aukeratu ostatze mota
          </option>
          <option
            v-bind:value="mota"
            v-for="(mota, index) in ostatzeak"
            v-bind:key="index"
          >
            {{ mota }}
          </option>
        </select>
      </div>
    </div>

    <div class="hoteles" id="hoteles">
      <div v-for="(hotel, index) in irazkiHotelak" v-bind:key="index" class="hotel shadow-sm d-flex gap-4 align-items-center" >
        <div>
          <img :src="'/img/default.png'" style="max-width: 10rem !important;">
        </div>
        <div class="w-100">
          <div class="d-flex justify-content-between">
            <span class="title">
              <a v-bind:href="'/hoteles/' + hotel.id">{{ hotel.documentName }}</a>
            </span>
            <i class="fa fa-heart fs-4 text-secondary"></i>
          </div>
          <span class="text-muted fw-normal">{{ hotel.lodgingType }}</span>
          <span class="text-muted d-block mb-2">
            {{ hotel.municipality }}, {{ hotel.territory }}, {{ hotel.country }}
          </span>
          <p v-html="truncate(hotel.turismDescription)"></p>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  mounted() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("probintzia"))
      this.probintzia = urlParams.get("probintzia").toLowerCase();
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
  }),

  computed: {
    /* hotelak filtratzen ditu izena, probintzia eta ostatze motaren arabera
    return bilaketa betetzen duten hotelak */
    irazkiHotelak() {
      let bilaketarenEmaitza = this.bilatuIzenarenArabera();
      if (this.probintzia.length > 0) {
        bilaketarenEmaitza =
          this.bilatuProbintziarenArabera(bilaketarenEmaitza);
      }
      if (this.sartutakoOstatzeMota.length > 0) {
        bilaketarenEmaitza =
          this.bilatuOstatzeMotarenArabera(bilaketarenEmaitza);
      }
      return bilaketarenEmaitza;
    },
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
    /* inputean sartutako izena hartu, 
    hotelen array-a filtratu eta return izena duten hotelen array-a */
    bilatuIzenarenArabera() {
      return this.hoteles.filter((hotel) =>
        hotel.documentName
          .toLowerCase()
          .includes(this.sartutakoIzena.toLowerCase())
      );
    },
    /* aukeratutako probintzia hartu, 
    array-a jaso parametro bezala eta filtratu probintziaren arabera.
    Return probintzia duten hotelen array-a */
    bilatuProbintziarenArabera(arrayDeResultadosRecibidos) {
      return arrayDeResultadosRecibidos.filter((hotel) =>
        hotel.territory.toLowerCase().includes(this.probintzia.toLowerCase())
      );
    },
    /* aukeratutako ostatze mota hartu, 
    array-a jaso parametro bezala eta filtratu motaren arabera.
    Return ostatze mota duten hotelen array-a */
    bilatuOstatzeMotarenArabera(arrayDeResultadosRecibidos) {
      return arrayDeResultadosRecibidos.filter((hotel) =>
        hotel.lodgingType.toLowerCase().includes(this.sartutakoOstatzeMota.toLowerCase())
      );
    },
  },
};
</script>
