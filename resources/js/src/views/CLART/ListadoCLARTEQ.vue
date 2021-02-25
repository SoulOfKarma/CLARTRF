<template>
    <vs-row>
        <div class="vx-col md:w-1/1 w-full mb-base">
            <vx-card title="Listado Seguimiento ART">
                <vue-good-table
                    :columns="columns"
                    :rows="listadoCLART"
                    :search-options="{
                        enabled: true
                    }"
                    :pagination-options="{
                        enabled: true,
                        perPage: pageLength
                    }"
                >
                    <template slot="table-row" slot-scope="props">
                        <!-- Column: Name -->
                        <span
                            v-if="props.column.field === 'fullName'"
                            class="text-nowrap"
                        >
                        </span>

                        <!-- Column: Action -->
                        <span v-else-if="props.column.field === 'action'">
                            <plus-circle-icon
                                size="1.5x"
                                class="custom-class"
                                @click="agregarNuevoDocumento(props.row.id)"
                            ></plus-circle-icon>
                            <info-icon
                                size="1.5x"
                                class="custom-class"
                                @click="informacionGeneral(props.row.id)"
                            ></info-icon>
                        </span>

                        <!-- Column: Common -->
                        <span v-else>
                            {{ props.formattedRow[props.column.field] }}
                        </span>
                    </template>
                </vue-good-table>
            </vx-card>
            <vs-popup
                classContent="popGuardarDoc"
                title="Subir Documento"
                :active.sync="popGuardarDoc"
            >
                <div class="vx-col md:w-1/1 w-full mb-base">
                    <div class="vx-row">
                        <div class="vx-col sm:w-full w-full ">
                            <vx-card>
                                <div class="vx-row mb-12">
                                    <div class="vx-col w-full mt-5">
                                        <vs-input
                                            type="file"
                                            @change="getImage"
                                            class="form-control w-full"
                                        />
                                    </div>
                                </div>
                            </vx-card>
                            <br />
                            <vx-card>
                                <div class="vx-col sm:w-full w-full ">
                                    <vs-button
                                        color="danger"
                                        type="filled"
                                        class="w-full"
                                        @click="uploadImage"
                                        >Guardar Documento</vs-button
                                    >
                                </div>
                                <br />
                                <div class="vx-col sm:w-full w-full ">
                                    <vs-button
                                        @click="popGuardarDoc = false"
                                        color="primary"
                                        class="w-full"
                                        type="filled"
                                        >Volver</vs-button
                                    >
                                </div>
                            </vx-card>
                        </div>
                    </div>
                </div>
            </vs-popup>
            <vs-popup
                classContent="popVerDoc"
                title="Ver Documentos"
                :active.sync="popVerDoc"
            >
                <div class="vx-col md:w-1/1 w-full mb-base">
                    <div class="vx-row">
                        <div class="vx-col sm:w-full w-full ">
                            <vx-card>
                                <vue-good-table
                                    :columns="col"
                                    :rows="listadoRegistroDocumentos"
                                    :search-options="{
                                        enabled: true
                                    }"
                                    :pagination-options="{
                                        enabled: true,
                                        perPage: pageLength
                                    }"
                                >
                                    <template
                                        slot="table-row"
                                        slot-scope="props"
                                    >
                                        <!-- Column: Name -->
                                        <span
                                            v-if="
                                                props.column.field ===
                                                    'fullName'
                                            "
                                            class="text-nowrap"
                                        >
                                        </span>

                                        <!-- Column: Action -->
                                        <span
                                            v-else-if="
                                                props.column.field === 'action'
                                            "
                                        >
                                            <plus-circle-icon
                                                size="1.5x"
                                                class="custom-class"
                                                @click="
                                                    verDoc(
                                                        props.row
                                                            .nombreDocumento
                                                    )
                                                "
                                            ></plus-circle-icon>
                                        </span>

                                        <!-- Column: Common -->
                                        <span v-else>
                                            {{
                                                props.formattedRow[
                                                    props.column.field
                                                ]
                                            }}
                                        </span>
                                    </template>
                                </vue-good-table>
                            </vx-card>
                            <br />
                            <vx-card>
                                <div class="vx-col sm:w-full w-full ">
                                    <vs-button
                                        @click="popVerDoc = false"
                                        color="primary"
                                        class="w-full"
                                        type="filled"
                                        >Volver</vs-button
                                    >
                                </div>
                            </vx-card>
                        </div>
                    </div>
                </div>
            </vs-popup>
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
import Vuesax from "vuesax";
import vSelect from "vue-select";
import VxCard from "../../components/vx-card/VxCard.vue";
import Datepicker from "vuejs-datepicker";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import moment from "moment";
import VueGoodTablePlugin from "vue-good-table";

// import the styles
import "vue-good-table/dist/vue-good-table.css";

Vue.use(VueGoodTablePlugin);

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
            pageLength: 10,
            dir: false,
            searchTerm: "",
            fileName: "",
            popGuardarDoc: false,
            popVerDoc: false,
            columns: [
                {
                    label: "ID",
                    field: "id",
                    type: "number"
                },
                {
                    label: "ID ART",
                    field: "idART",
                    type: "number"
                },
                {
                    label: "Rut Proveedor",
                    field: "rutProveedor"
                },
                {
                    label: "Descripcion Proveedor",
                    field: "descripcionProveedor"
                },
                {
                    label: "Monto",
                    field: "monto",
                    type: "number"
                },

                {
                    label: "N° Factura",
                    field: "nfactura",
                    type: "number"
                },
                {
                    label: "Fecha Emision Factura",
                    field: "fechaemifac",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "dd/MM/yyyy"
                },
                {
                    label: "Fecha Entrega Contabilidad",
                    field: "fechaentcont",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "dd/MM/yyyy"
                },
                {
                    label: "Opciones",
                    field: "action"
                }
            ],
            col: [
                {
                    label: "ID",
                    field: "id",
                    type: "number"
                },
                {
                    label: "ID ART",
                    field: "idCLART",
                    type: "number"
                },
                {
                    label: "Documentos",
                    field: "action"
                }
            ],
            listadoCLART: [],
            listadoRegistroDocumentos: [],
            idART: 0,
            localVal: process.env.MIX_APP_URL,
            urlDocumentos: process.env.MIX_APP_URL_DOCUMENTOS,
            image: ""
        };
    },
    methods: {
        verDoc(doc) {
            const url = this.urlDocumentos + doc;
            console.log(url);
            window.open(url, "_blank");
        },
        informacionGeneral(id) {
            try {
                this.popVerDoc = true;
                axios
                    .get(
                        this.localVal +
                            `/api/CLART/GetRegistroDocumentosF/${id}`,
                        {
                            headers: {
                                Authorization:
                                    `Bearer ` + sessionStorage.getItem("token")
                            }
                        }
                    )
                    .then(res => {
                        this.listadoRegistroDocumentos = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        agregarNuevoDocumento(id) {
            this.popGuardarDoc = true;
            this.idART = id;
        },
        getImage(event) {
            //Asignamos la imagen a  nuestra data
            this.image = event.target.files[0];
        },
        uploadImage() {
            //Creamos el formData
            var data = new FormData();
            //Añadimos la imagen seleccionada
            data.append("avatar", this.image);
            data.append("id", this.idART);
            axios
                .post(this.localVal + "/api/CLART/PostDocumentoF", data, {
                    headers: {
                        Authorization:
                            `Bearer ` + sessionStorage.getItem("token")
                    }
                })
                .then(response => {
                    let resp = response.data;
                    if (resp == true) {
                        this.$vs.notify({
                            title: "Documento Guardado ",
                            text:
                                "Podra Visualizarlo en el menu del costado para descargarlo o visualizarlo en el navegador ",
                            color: "success",
                            position: "top-right"
                        });
                        this.popGuardarDoc = false;
                    } else {
                        this.$vs.notify({
                            title: "Error al subir el documento ",
                            text:
                                "Intente nuevamente con el formato PDF o alguna Imagen ",
                            color: "danger",
                            position: "top-right"
                        });
                    }
                });
        },
        cargarCLART() {
            try {
                axios
                    .get(this.localVal + "/api/CLART/GetRegistroCLARTSCatEQ", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let list = res.data;
                        const formatter = new Intl.NumberFormat("en-US", {
                            style: "currency",
                            currency: "USD",
                            minimumFractionDigits: 0
                        });
                        let b = [];

                        list.forEach((value, index) => {
                            value.monto = formatter.format(value.monto);
                            b.push(value);
                        });

                        this.listadoCLART = b;
                    });
            } catch (error) {
                console.log(error);
            }
        }
    },
    created: function() {
        this.cargarCLART();
    }
};
</script>
