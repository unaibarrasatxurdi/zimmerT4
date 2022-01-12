<template>
  <div>
    <div v-if="hoteles.length == 0" class="d-flex gap-3 justify-content-center align-items-center">
      <div class="spinner-border text-secondary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <span class="text-muted">Buscando hoteles</span>
    </div>

    <div>
      <div v-if="provincia.length > 0">
        <h4>'{{ provincia }}'-ko hotelak</h4>
        <p class="text-muted">{{ irazkiHotelak.length }} hotel aurkituta</p>
      </div>
      <div v-else>
        <h4>Euskadiko hotelak</h4>
        <p class="text-muted">{{ irazkiHotelak.length }} hotel aurkituta</p>
      </div>
    </div>

    <div v-if="hoteles.length > 0" class="mb-5">
      <input v-model="sartutakoIzena" id="filtro-nombre" type="text" class="form-control" placeholder="Bilatu hotelak"/>
      <div class="d-flex gap-3 mt-3">
        <select v-on:change="aldatuProbintzia($event)" id="filtro-provincia" class="form-select">
          <option default selected hidden>Aukeratu probintzia</option>
          <option value="Bizkaia">Bizkaia</option>
          <option value="Gipuzkoa">Gipuzkoa</option>
          <option value="Araba">Araba</option>
        </select>
        <select v-on:change="aldatuOstatzeMota($event)" id="filtro-tipo" class="form-select">
          <option default selected hidden>Aukeratu ostatze mota</option>
          <option v-bind:value="mota" v-for="(mota, index) in ostatzeak" v-bind:key="index">
            {{ mota }}
          </option>
        </select>
      </div>
    </div>

    <div class="hoteles">
      <div v-for="(hotel, index) in irazkiHotelak" v-bind:key="index" class="hotel shadow-sm">
        <div class="d-flex justify-content-between">
          <span class="title"><a v-bind:href="'/hoteles/' + hotel.id">{{ hotel.documentName }}</a></span>
          <i class="fa fa-heart fs-4 text-secondary"></i>
        </div>
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
    if (urlParams.get("provincia"))
      this.provincia = urlParams.get("provincia").toLowerCase();
    this.getHoteles();
  },

  data: () => ({
    title: "Hoteles de euskadi",
    hoteles: [],
    likes: [],
    provincia: "",
    sartutakoIzena: "",
    sartutakoOstatzeMota: "",
    hoteles: [],
    ostatzeMotak: [],
  }),

  computed: {
    irazkiHotelak() {
      let bilaketarenEmaitza = this.bilatuIzenarenArabera();
      if (this.provincia.length > 0) {
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
    getHoteles() {
      const URL =
        "https://opendata.euskadi.eus/contenidos/ds_recursos_turisticos/hoteles_de_euskadi/opendata/alojamientos.json";
      axios.get(URL).then((response) => {
        let data = new String(response.data)
          .replace("jsonCallback(", "")
          .replace(");", "");
        this.hoteles = JSON.parse(data);
        for (let i = 0; i < this.hoteles.length; i++) {
          this.hoteles[i].id = i;
        }
        this.ostatzeMotak = this.getOstatzeMotak();
      });
    },
    truncate(descripcion) {
      if (descripcion.length > 100) {
        return descripcion.substring(0, 100) + "...";
      } else {
        return descripcion;
      }
    },
    getOstatzeMotak() {
      let ostatzeMootaGuztiak = this.hoteles
        .map((hotel) => hotel.lodgingType)
        .sort()
        .reduce(function (a, b) {
          if (a.slice(-1)[0] !== b) a.push(b);
          return a;
        }, []);
      return ostatzeMootaGuztiak;
    },
    aldatuOstatzeMota(event) {
      this.sartutakoOstatzeMota = event.target.value;
    },
    aldatuProbintzia(event) {
      this.provincia = event.target.value;
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
        hotel.territory.includes(this.provincia)
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
