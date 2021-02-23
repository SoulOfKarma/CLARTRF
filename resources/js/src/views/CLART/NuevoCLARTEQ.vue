<template>
    <vs-row>
        <div class="vx-col md:w-1/1 w-full mb-base">
            <vx-card title="Llenar formulario con datos existentes">
                <div class="vx-row mb-4">
                    <div class="vx-col w-1/2 mt-5">
                        <h6>ID Art:</h6>
                        <br />
                        <vs-input class="inputx w-full"></vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Proveedor:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            taggable
                            label="descripcionOrdenCompras"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Monto:</h6>
                        <br />
                        <vs-input class="inputx w-full"></vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Factura:</h6>
                        <br />
                        <vs-input class="inputx w-full"></vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Fecha Emision Factura</h6>
                        <br />
                        <flat-pickr
                            :config="configFromdateTimePicker"
                            v-model="fechaFactura"
                            placeholder="Fecha Factura"
                            @on-change="onFromChange"
                            class="w-full"
                        />
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Fecha Entrega a Contabilidad</h6>
                        <br />
                        <flat-pickr
                            :config="configTodateTimePicker"
                            v-model="fechaEmisionContabilidad"
                            placeholder="Fecha Emision Contabilidad"
                            @on-change="onToChange"
                            class="w-full"
                        />
                    </div>
                    <!-- <div class="vx-col w-full mt-5">
                        <vs-button
                            class="fixedHeight w-full"
                            color="primary"
                            @click="popSubirDoc"
                            >Subir Documentos</vs-button
                        >
                    </div> -->
                    <div class="vx-col w-full mt-5">
                        <h6>Adjuntar Documento</h6>
                        <br />
                        <vs-input
                            type="file"
                            @change="getImage"
                            class="form-control w-full"
                        />
                    </div>
                </div>
            </vx-card>
            <br />
            <vx-card title="">
                <div class="vx-row mb-4">
                    <div class="vx-col w-1/2 mt-5">
                        <vs-button class="fixedHeight w-full" color="primary"
                            >Volver</vs-button
                        >
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <vs-button
                            class="fixedHeight w-full"
                            color="success"
                            @click="guardarCLART"
                            >Guardar</vs-button
                        >
                    </div>
                </div>
            </vx-card>
        </div>
    </vs-row>
</template>
<script>
import axios from "axios";
import router from "@/router";
import { InfoIcon } from "vue-feather-icons";
import { PlusCircleIcon } from "vue-feather-icons";
import { Trash2Icon } from "vue-feather-icons";
import { UploadIcon } from "vue-feather-icons";
import { CornerDownRightIcon } from "vue-feather-icons";
import { ArchiveIcon } from "vue-feather-icons";
import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import { quillEditor } from "vue-quill-editor";
import Vue from "vue";
import vSelect from "vue-select";
import VxCard from "../../components/vx-card/VxCard.vue";
import Datepicker from "vuejs-datepicker";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import moment from "moment";
export default {
    components: {
        ArchiveIcon,
        InfoIcon,
        PlusCircleIcon,
        Trash2Icon,
        UploadIcon,
        CornerDownRightIcon,
        flatPickr,
        "v-select": vSelect,
        quillEditor
    },
    data() {
        return {
            editorOption: {
                modules: {
                    toolbar: [
                        ["bold", "italic", "underline", "strike"],
                        ["blockquote", "code-block"],
                        [{ header: 1 }, { header: 2 }],
                        [{ list: "ordered" }, { list: "bullet" }],
                        [{ indent: "-1" }, { indent: "+1" }],
                        [{ direction: "rtl" }],
                        [{ font: [] }],
                        [{ align: [] }],
                        ["clean"]
                    ]
                }
            },
            configFromdateTimePicker: {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                        longhand: [
                            "Domingo",
                            "Lunes",
                            "Martes",
                            "Miércoles",
                            "Jueves",
                            "Viernes",
                            "Sábado"
                        ]
                    },
                    months: {
                        shorthand: [
                            "Ene",
                            "Feb",
                            "Mar",
                            "Abr",
                            "May",
                            "Jun",
                            "Jul",
                            "Ago",
                            "Sep",
                            "Оct",
                            "Nov",
                            "Dic"
                        ],
                        longhand: [
                            "Enero",
                            "Febrero",
                            "Мarzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre"
                        ]
                    }
                }
            },
            configTodateTimePicker: {
                altInput: true,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                        longhand: [
                            "Domingo",
                            "Lunes",
                            "Martes",
                            "Miércoles",
                            "Jueves",
                            "Viernes",
                            "Sábado"
                        ]
                    },
                    months: {
                        shorthand: [
                            "Ene",
                            "Feb",
                            "Mar",
                            "Abr",
                            "May",
                            "Jun",
                            "Jul",
                            "Ago",
                            "Sep",
                            "Оct",
                            "Nov",
                            "Dic"
                        ],
                        longhand: [
                            "Enero",
                            "Febrero",
                            "Мarzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Diciembre"
                        ]
                    }
                }
            },
            configdateTimePicker: {
                enableTime: true,
                enableSeconds: true,
                noCalendar: false
            },
            fechaEmisionContabilidad: new Date(),
            fechaFactura: new Date(),
            image: "",
            value3: ""
        };
    },
    methods: {
        //Metodos Reusables
        isNumber: function(evt) {
            evt = evt ? evt : window.event;
            var charCode = evt.which ? evt.which : evt.keyCode;
            if (
                charCode > 31 &&
                (charCode < 48 || charCode > 57) &&
                charCode !== 46
            ) {
                evt.preventDefault();
            } else {
                return true;
            }
        },
        limpiar() {},
        onFromChange(selectedDates, dateStr, instance) {
            this.$set(this.configTodateTimePicker, dateStr);
        },
        onToChange(selectedDates, dateStr, instance) {
            this.$set(this.configFromdateTimePicker, dateStr);
        },
        //Fin Metodos Reusables
        //Conversor de Montos y Saldos
        convertirMonto() {
            try {
                const formatter = new Intl.NumberFormat("en-US", {
                    style: "currency",
                    currency: "USD",
                    minimumFractionDigits: 0
                });

                this.montoData = this.montoART;
                this.montoART = formatter.format(this.montoData);
            } catch (error) {
                console.log(error);
            }
        },
        retornarMonto() {
            try {
                this.montoART = this.montoData;
            } catch (error) {
                console.log(error);
            }
        },
        //Fin de Conversor
        //Subir Documentos
        getImage(event) {
            //Asignamos la imagen a  nuestra data
            this.image = event.target.files[0];
        },
        guardarCLART() {
            //Creamos el formData
            var data = new FormData();
            //Añadimos la imagen seleccionada
            data.append("avatar", this.image);
            data.append("id", this.value3);
            /* axios
                .post(this.localVal + "/api/Agente/PostDocumentoF", data, {
                    headers: {
                        Authorization:
                            `Bearer ` + sessionStorage.getItem("token")
                    }
                })
                .then(response => {
                    if (response.data) {
                        this.$vs.notify({
                            title: "Documento Guardado ",
                            text:
                                "Podra Visualizarlo en el menu del costado para descargarlo o visualizarlo en el navegador ",
                            color: "success",
                            position: "top-right"
                        });
                        this.popupActive3 = false;
                    } else {
                        this.$vs.notify({
                            title: "Error al subir el documento ",
                            text:
                                "Intente nuevamente con el formato PDF o alguna Imagen ",
                            color: "danger",
                            position: "top-right"
                        });
                    }
                }); */
        }
        //Fin Subir Documentos
    }
};
</script>
