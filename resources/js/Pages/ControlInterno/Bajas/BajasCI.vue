<script setup>
import { watchEffect, ref, reactive, onMounted } from "vue";
import CardCi from "../Partials/CardCi.vue";
import TablaBajas from "./Partials/TablaBajas.vue";
import GraficaBarrasCXP from "../CXP/Partials/GraficaBarrasCXP.vue";
import RiesgoRadarNomina from "../Nominas/Partials/RiesgoRadarNomina.vue";
import GraficaPorcentaje from "../Partials/GraficaPorcentaje.vue";
import ModalAddBajas from "./Modals/ModalAddBajas.vue";
import Titulos from "../Partials/Titulos.vue";

const props = defineProps({
    show: {
        type: Object,
        default: false,
    },
});

const tabla = reactive({
    atributos: [],
    parametros: [],
    data: [],
});

const graphBar = reactive({});
const graphPorcentaje = ref(0);
const riesgoRadar = ref(0);
const modalAddAlta = ref(false);
const position = ref();

watchEffect(() => (props.show ? getData() : null));
function getData() {
    axios
        .get(route("dataBajas"))
        .then(({ data }) => {
            tabla.atributos = data.atributos;
            tabla.parametros = data.parametros;
            tabla.data = data.data;
            Object.values(data.data).forEach((element) => {
                switch (element[0].atributo) {
                    case 27:
                        graphBar.Nombre = {
                            value: element[0].value,
                            name: "Formato de Baja",
                        };
                        break;
                    case 28:
                        graphBar.NSS = {
                            value: element[0].value,
                            name: "Autorizacion de Baja",
                        };
                        break;
                    case 29:
                        graphBar.RFC = {
                            value: element[0].value,
                            name: "Datos del Formato de Baja",
                        };
                        break;
                    case 30:
                        graphBar.Ingreso = {
                            value: element[0].value,
                            name: "Correo de solicitud de Baja",
                        };
                        break;
                    case 31:
                        graphBar.d = {
                            value: element[0].value,
                            name: "Baja de IDSE",
                        };
                        break;
                    case 32:
                        graphBar.e = {
                            value: element[0].value,
                            name: "Carta de Renuncia",
                        };
                        break;
                    case 33:
                        graphBar.f = {
                            value: element[0].value,
                            name: "Baja de INTRANET",
                        };
                        break;
                    case 34:
                        graphBar.g = {
                            value: element[0].value,
                            name: "Formato de Baja P&G",
                        };
                        break;
                    case 35:
                        graphBar.h = {
                            value: element[0].value,
                            name: "Correo para solicitud de baja P&G",
                        };
                        break;
                }
            });
            graphPorcentaje.value = data.dataPorcentaje;
            riesgoRadar.value = data.dataRadar;
        })
        .catch((err) => console.log(err.response ?? err));
}
onMounted(() =>
    Echo.channel("dataBajas").listen("SuaEvent", () =>
        props.show ? getData() : null
    )
);
</script>
<template>
    <CardCi>
        <div class="flex items-center justify-between">
            <div class="grid w-7/12">
                <div class="flex justify-between">
                    <GraficaPorcentaje :porcentaje="graphPorcentaje" />
                    <RiesgoRadarNomina :riesgo="riesgoRadar" />
                </div>
                <div class="grid w-full justify-items-center">
                    <Titulos
                        value="Rango porcentual de cumplimiento"
                        class="text-[20px] w-fit"
                    />
                    <GraficaBarrasCXP :data="graphBar" />
                </div>
            </div>
            <div class="grid w-5/12">
                <TablaBajas
                    :data="tabla"
                    @add="
                        (e) => {
                            position = e;
                            modalAddAlta = true;
                        }
                    "
                />
            </div>
        </div>
    </CardCi>
    <ModalAddBajas
        :show="modalAddAlta"
        @close="modalAddAlta = false"
        :position="position"
        maxWidth="6xl"
    />
</template>
