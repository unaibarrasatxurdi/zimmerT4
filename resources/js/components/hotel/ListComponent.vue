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
      <div v-if="probintzia.length > 0">
        <h4>'{{ probintzia }}'-ko hotelak</h4>
        <p class="text-muted">{{ irazkiHotelak.length }} hotel aurkituta</p>
      </div>
      <div v-else>
        <h4>Euskadiko hotelak</h4>
        <p class="text-muted">{{ irazkiHotelak.length }} hotel aurkituta</p>
      </div>
    </div>

    <div v-if="hoteles.length > 0" class="mb-5">
      <input
        v-model="sartutakoIzena"
        id="filtro-nombre"
        type="text"
        class="form-control"
        placeholder="Bilatu hotelak"
      />
      <div class="d-flex gap-3 mt-3">
        <!--v-on:change="aldatuProbintzia($event)"-->
        <select v-model="probintzia" id="filtro-probintzia" class="form-select">
          <option default selected hidden>Aukeratu probintzia</option>
          <option value="Bizkaia">Bizkaia</option>
          <option value="Gipuzkoa">Gipuzkoa</option>
          <option value="Araba">Araba</option>
        </select>
        <select
          v-model="sartutakoOstatzeMota"
          id="filtro-tipo"
          class="form-select"
        >
          <option default selected hidden>Aukeratu ostatze mota</option>
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

    <div class="hoteles" id="mhoteles">
      <div
        v-for="(hotel, index) in irazkiHotelak"
        v-bind:key="index"
        class="hotel shadow-sm"
      >
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
</template>


<script>
export default {
  mounted() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get("probintzia"))
      this.probintzia = urlParams.get("probintzia").toLowerCase();
    this.getHoteles();

    //Pagination
   

     $("#mhoteles").Pagination()({
      dataSource: [1, 2, 3, 4, 5, 6, 7, 100],
      pageSize: 5,
      showPrevious: false,
      showNext: false,
      callback: function (data, pagination) {
        // template method of yourself
        var html = template(data);
        dataContainer.html(html);
      },
    });
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
    bilatuIzenarenArabera() {
      return this.hoteles.filter((hotel) =>
        hotel.documentName
          .toLowerCase()
          .includes(this.sartutakoIzena.toLowerCase())
      );
    },
    bilatuProbintziarenArabera(arrayDeResultadosRecibidos) {
      return arrayDeResultadosRecibidos.filter((hotel) =>
        hotel.territory.includes(this.probintzia)
      );
    },
    bilatuOstatzeMotarenArabera(arrayDeResultadosRecibidos) {
      return arrayDeResultadosRecibidos.filter((hotel) =>
        hotel.lodgingType.includes(this.sartutakoOstatzeMota)
      );
    },
  },
};
</script>
