<script setup>
import { watchEffect, ref, reactive, onMounted } from "vue";
import CardCi from "../Partials/CardCi.vue";
import TablaBajas from "../Bajas/Partials/TablaBajas.vue";
import GraficaBarrasCXP from "../CXP/Partials/GraficaBarrasCXP.vue";
import RiesgoRadarNomina from "../Nominas/Partials/RiesgoRadarNomina.vue";
import GraficaLineasNomina from "../Nominas/Partials/GraficaLineasNomina.vue";
import ModalAddCompras from "./Modals/ModalAddCompras.vue";
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
const graphLine = ref({});
const riesgoRadar = ref(0);
const modalCompras = ref(false);
const position = ref();

watchEffect(() => (props.show ? getData() : null));
function getData() {
    axios
        .get(route("dataCompras"))
        .then(({ data }) => {
            tabla.atributos = data.atributos;
            tabla.parametros = data.parametros;
            tabla.data = data.data;
            Object.values(data.data).forEach((element) => {
                switch (element[0].atributo) {
                    case 36:
                        graphBar.Nombre = {
                            value: element[0].value,
                            name: "Formato de Req. de Compra",
                        };
                        break;
                    case 37:
                        graphBar.NSS = {
                            value: element[0].value,
                            name: "Tiempo de Respuesta",
                        };
                        break;
                    case 38:
                        graphBar.RFC = {
                            value: element[0].value,
                            name: "Cuadro comparativo / Cotizacion",
                        };
                        break;
                    case 39:
                        graphBar.Ingreso = {
                            value: element[0].value,
                            name: "Formato de Autorizacion de Compra",
                        };
                        break;
                    case 40:
                        graphBar.d = {
                            value: element[0].value,
                            name: "Contrarecibo",
                        };
                        break;
                    case 41:
                        graphBar.e = {
                            value: element[0].value,
                            name: "Formato unico para gastos diversos / factura",
                        };
                        break;
                    case 42:
                        graphBar.f = {
                            value: element[0].value,
                            name: "Cumplimiento del proceso de inicio a fin",
                        };
                        break;
                }
            });
            graphLine.value = data.garphLine;
            riesgoRadar.value = data.dataRadar;
        })
        .catch((err) => console.log(err.response ?? err));
}
onMounted(() =>
    Echo.channel("dataCompras").listen("SuaEvent", () =>
        props.show ? getData() : null
    )
);
</script>
<template>
    <CardCi>
        <div class="flex items-center justify-between">
            <div class="grid w-8/12">
                <div class="flex justify-between">
                    <GraficaLineasNomina :data="graphLine" />
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
            <div class="grid w-4/12">
                <TablaBajas
                    :data="tabla"
                    @add="
                        (e) => {
                            position = e;
                            modalCompras = true;
                        }
                    "
                />
            </div>
        </div>
    </CardCi>
    <ModalAddCompras
        :show="modalCompras"
        @close="modalCompras = false"
        :position="position"
        maxWidth="6xl"
    />
</template>
