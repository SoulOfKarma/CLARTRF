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
                                @click="agregarNuevoDocumento(props.row.idART)"
                            ></plus-circle-icon>
                            <info-icon
                                size="1.5x"
                                class="custom-class"
                                @click="informacionGeneral(props.row.idART)"
                            ></info-icon>
                            <upload-icon
                                size="1.5x"
                                class="custom-class"
                                @click="cambiarEstado(props.row.idART)"
                            ></upload-icon>
                            <upload-cloud-icon
                                size="1.5x"
                                class="custom-class"
                                @click="popModART(props.row.id)"
                            ></upload-cloud-icon>
                            <trash-2-icon
                                size="1.5x"
                                class="custom-class"
                                @click="popBorrarRegistro(props.row.id)"
                            ></trash-2-icon>
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
                                            <trash-2-icon
                                                size="1.5x"
                                                class="custom-class"
                                                @click="
                                                    popConfirmacionEliminacionDocumento(
                                                        props.row.id
                                                    )
                                                "
                                            ></trash-2-icon>
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
            <vs-popup
                classContent="popEstado"
                title="Cambiar Estado"
                :active.sync="popEstado"
            >
                <div class="vx-col md:w-1/1 w-full mb-base">
                    <div class="vx-row">
                        <div class="vx-col sm:w-full w-full ">
                            <vx-card>
                                <div class="vx-col sm:w-full w-full ">
                                    <h6>Estado:</h6>
                                    <br />
                                    <v-select
                                        class="w-full select-large"
                                        taggable
                                        label="descripcionEstado"
                                        v-model="seleccionEstados"
                                        :options="listadoEstados"
                                    ></v-select>
                                </div>
                                <br />
                                <div class="vx-col sm:w-full w-full ">
                                    <vs-button
                                        class="fixedHeight w-full"
                                        color="warning"
                                        @click="guardarCambioEstado()"
                                        >Realizar Cambio</vs-button
                                    >
                                </div>
                            </vx-card>
                        </div>
                    </div>
                </div>
            </vs-popup>
            <vs-popup
                classContent="popUpdate"
                title="Modificar Data"
                :active.sync="popUpdate"
            >
                <div class="vx-col md:w-1/1 w-full mb-base">
                    <div class="vx-row">
                        <div class="vx-col sm:w-full w-full ">
                            <vx-card
                                title="Modificar formulario con datos existentes"
                            >
                                <div class="vx-row mb-4">
                                    <div class="vx-col w-1/2 mt-5">
                                        <h6>ID Art:</h6>
                                        <br />
                                        <vs-input
                                            class="inputx w-full"
                                            v-model="idARTMOD"
                                        ></vs-input>
                                    </div>
                                    <div class="vx-col w-1/2 mt-5">
                                        <h6>Proveedor:</h6>
                                        <br />
                                        <v-select
                                            class="w-full select-large"
                                            taggable
                                            label="rutProveedor"
                                            v-model="seleccionProveedor"
                                            :options="listadoProveedores"
                                            @input="popAbrirProveedor"
                                        ></v-select>
                                    </div>
                                    <div class="vx-col w-1/2 mt-5">
                                        <h6>Descripcion Proveedor:</h6>
                                        <br />
                                        <vs-input
                                            class="inputx w-full"
                                            readonly
                                            v-model="
                                                seleccionProveedor.descripcionProveedor
                                            "
                                        ></vs-input>
                                    </div>
                                    <div class="vx-col w-1/2 mt-5">
                                        <h6>Estado:</h6>
                                        <br />
                                        <v-select
                                            class="w-full select-large"
                                            taggable
                                            label="descripcionEstado"
                                            v-model="seleccionEstados"
                                            :options="listadoEstados"
                                        ></v-select>
                                    </div>
                                    <div class="vx-col w-1/2 mt-5">
                                        <h6>Monto:</h6>
                                        <br />
                                        <vs-input
                                            class="inputx w-full"
                                            v-model="monto"
                                            @blur="convertirMonto"
                                            @focus="retornarMonto"
                                            @keypress="isNumber($event)"
                                        ></vs-input>
                                    </div>
                                    <div class="vx-col w-1/2 mt-5">
                                        <h6>N° Factura:</h6>
                                        <br />
                                        <vs-input
                                            class="inputx w-full"
                                            v-model="nfactura"
                                            @keypress="isNumber($event)"
                                        ></vs-input>
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
                                        <h6>
                                            Fecha Entrega a Contabilidad
                                        </h6>
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
                                    <!-- <div class="vx-col w-full mt-5">
                        <h6>Adjuntar Documento</h6>
                        <br />
                        <vs-input
                            type="file"
                            @change="getImage"
                            class="form-control w-full"
                        />
                    </div> -->
                                </div>
                            </vx-card>
                            <br />
                            <vx-card title="">
                                <div class="vx-row mb-4">
                                    <div class="vx-col w-1/2 mt-5">
                                        <vs-button
                                            class="fixedHeight w-full"
                                            color="primary"
                                            @click="popUpdate = false"
                                            >Volver</vs-button
                                        >
                                    </div>
                                    <div class="vx-col w-1/2 mt-5">
                                        <vs-button
                                            class="fixedHeight w-full"
                                            color="warning"
                                            @click="modificarCLART"
                                            >Guardar</vs-button
                                        >
                                    </div>
                                </div>
                            </vx-card>
                        </div>
                    </div>
                </div>
            </vs-popup>
        </div>
        <vs-popup
            classContent="popProveedor"
            title="Agregar Nuevo Proveedor"
            :active.sync="popProveedor"
        >
            <div class="vx-col w-full mb-base">
                <div class="vx-row mb-4">
                    <vx-card>
                        <div class="vx-col w-full ">
                            <h6>Rut Proveedor:</h6>
                            <br />
                            <vs-input
                                class="inputx w-full"
                                v-model="rutProveedorN"
                                v-on:blur="formatear_run"
                            ></vs-input>
                            <span
                                style="font-size: 10px; color: red; margin-left: 10px"
                                v-if="val_run"
                                >Rut Proveedor Incorrecto</span
                            >
                        </div>
                        <br />
                        <div class="vx-col w-full ">
                            <h6>Descripcion Proveedor:</h6>
                            <br />
                            <vs-input
                                class="inputx w-full"
                                v-model="descripcionProveedorN"
                            ></vs-input>
                        </div>
                    </vx-card>
                    <br />
                    <vx-card title="">
                        <div class="vx-row mb-4">
                            <div class="vx-col w-1/2 mt-5">
                                <vs-button
                                    class="w-full"
                                    color="primary"
                                    @click="popProveedor = false"
                                    >Volver</vs-button
                                >
                            </div>
                            <br />
                            <div class="vx-col w-1/2 mt-5">
                                <vs-button
                                    class="w-full"
                                    color="warning"
                                    @click="guardarNuevoProveedor()"
                                    >Guardar Proveedor</vs-button
                                >
                            </div>
                        </div>
                    </vx-card>
                </div>
            </div>
        </vs-popup>
        <vs-popup
            classContent="popBorrarR"
            title="Realmente Requiere Eliminar Este ART?"
            :active.sync="popBorrarR"
        >
            <div class="vx-col w-full mb-base">
                <div class="vx-row mb-4">
                    <vx-card title="">
                        <div class="vx-row mb-4">
                            <div class="vx-col w-1/2 mt-5">
                                <vs-button
                                    class="w-full"
                                    color="primary"
                                    @click="popBorrarR = false"
                                    >Volver</vs-button
                                >
                            </div>
                            <br />
                            <div class="vx-col w-1/2 mt-5">
                                <vs-button
                                    class="w-full"
                                    color="warning"
                                    @click="popDeleteART(idARTEliminar)"
                                    >Eliminar Registro</vs-button
                                >
                            </div>
                        </div>
                    </vx-card>
                </div>
            </div>
        </vs-popup>
        <vs-popup
            classContent="popDeleteDoc"
            title="Realmente desea eliminar este documento?"
            :active.sync="popDeleteDoc"
        >
            <div class="vx-col w-full mb-base">
                <div class="vx-row mb-4">
                    <vx-card title="">
                        <div class="vx-row mb-4">
                            <div class="vx-col w-1/2 mt-5">
                                <vs-button
                                    class="w-full"
                                    color="primary"
                                    @click="
                                        (popDeleteDoc = false),
                                            (popVerDoc = true)
                                    "
                                    >Volver</vs-button
                                >
                            </div>
                            <br />
                            <div class="vx-col w-1/2 mt-5">
                                <vs-button
                                    class="w-full"
                                    color="warning"
                                    @click="deleteDocumento()"
                                    >Eliminar Documento</vs-button
                                >
                            </div>
                        </div>
                    </vx-card>
                </div>
            </div>
        </vs-popup>
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
import { UploadCloudIcon } from "vue-feather-icons";
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
import { validate, clean, format } from "rut.js";

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
        quillEditor,
        UploadCloudIcon
    },
    data() {
        return {
            //Lado Listado
            pageLength: 10,
            dir: false,
            searchTerm: "",
            fileName: "",
            popGuardarDoc: false,
            popVerDoc: false,
            popEstado: false,
            popUpdate: false,
            columns: [
                {
                    label: "ID",
                    field: "id",
                    type: "number"
                },
                {
                    label: "ID ART",
                    field: "idART"
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
                    field: "fechaentcont"
                },
                {
                    label: "Fecha Ultima Actualizacion",
                    field: "updated_at",
                    type: "date",
                    dateInputFormat: "yyyy-MM-dd",
                    dateOutputFormat: "dd/MM/yyyy"
                },
                {
                    label: "Estado",
                    field: "descripcionEstado"
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
                    label: "Descripcion Documento",
                    field: "descripcionDocumento"
                },
                {
                    label: "Documentos",
                    field: "action"
                }
            ],
            listadoCLART: [],
            listadoRegistroDocumentos: [],
            listadoEstados: [],
            seleccionEstados: {
                id: 0,
                descripcionEstado: ""
            },
            idART: 0,
            localVal: process.env.MIX_APP_URL,
            urlDocumentos: process.env.MIX_APP_URL_DOCUMENTOS,
            image: "",
            idARTEstado: 0,
            //Lado Update ART
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
            seleccionProveedor: {
                id: 0,
                rutProveedor: "",
                descripcionProveedor: ""
            },
            seleccionEstados: {
                id: 1,
                descripcionEstado: "Ingresado"
            },
            fechaEmisionContabilidad: moment().format("YYYY-MM-DD"),
            fechaFactura: moment().format("YYYY-MM-DD"),
            image: "",
            value3: "",
            idARTMOD: "",
            monto: 0,
            montof: 0,
            nfactura: 0,
            listadoProveedores: [],
            listadoEstados: [],
            listadoModClart: [],
            desDoc: "",
            idMod: 0,
            rutProveedorN: "",
            descripcionProveedorN: "",
            popProveedor: false,
            val_run: false,
            popBorrarR: false,
            popDeleteDoc: false,
            idARTEliminar: "",
            idDelDoc: 0
        };
    },
    methods: {
        //Metodos Reutilizables
        formatear_run() {
            if (this.rutProveedorN == "" || this.rutProveedorN == null) {
                console.log("Sin Rut");
                this.val_run = false;
            } else {
                this.rutProveedorN = format(this.rutProveedorN);
                this.val_run = !validate(this.rutProveedorN);
            }
        },
        //Proveedor
        popAbrirProveedor() {
            try {
                if (
                    this.seleccionProveedor.id == 0 ||
                    this.seleccionProveedor.id == null
                ) {
                    this.popUpdate = false;
                    this.popProveedor = true;
                    this.rutProveedorN = this.seleccionProveedor.rutProveedor;
                }
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoProveedor() {
            try {
                if (
                    this.rutProveedorN == "" ||
                    this.rutProveedorN == null ||
                    this.descripcionProveedorN == "" ||
                    this.descripcionProveedorN == null
                ) {
                    this.$vs.notify({
                        title: "Error ",
                        text:
                            "Rut o Descripcion Proveedor no Ingresados, verifique y intente nuevamente ",
                        color: "success",
                        position: "top-right"
                    });
                } else {
                    let objeto = {
                        rutProveedor: this.rutProveedorN,
                        descripcionProveedor: this.descripcionProveedorN
                    };
                    axios
                        .post(
                            this.localVal + "/api/CLART/PostProveedor",
                            objeto,
                            {
                                headers: {
                                    Authorization:
                                        `Bearer ` +
                                        sessionStorage.getItem("token")
                                }
                            }
                        )
                        .then(res => {
                            let resp1 = res.data;
                            if (resp1 == true) {
                                this.$vs.notify({
                                    title: "Proveedor Guardado ",
                                    text:
                                        "Se recargara listado de proveedores ",
                                    color: "success",
                                    position: "top-right"
                                });
                                this.popProveedor = false;
                                this.cargarProveedores();
                                this.seleccionProveedor.id = 0;
                                this.seleccionProveedor.rutProveedor = "";
                                this.seleccionProveedor.descripcionProveedor =
                                    "";
                                this.rutProveedorN = "";
                                this.descripcionProveedorN = "";
                            } else {
                                this.$vs.notify({
                                    title: "Error ",
                                    text:
                                        "No fue posible registrar el proveedor, intente nuevamente ",
                                    color: "danger",
                                    position: "top-right"
                                });
                            }
                        });
                }
            } catch (error) {
                console.log(error);
            }
        },
        //Fin Proveedor
        verDoc(doc) {
            const url = this.urlDocumentos + doc;
            console.log(url);
            window.open(url, "_blank");
        },
        informacionGeneral(id) {
            try {
                this.popVerDoc = true;
                let objeto = {
                    idART: id
                };
                axios
                    .post(
                        this.localVal + "/api/CLART/GetRegistroDocumentosF",
                        objeto,
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
        popModART(id) {
            try {
                const formatter = new Intl.NumberFormat("en-US", {
                    style: "currency",
                    currency: "USD",
                    minimumFractionDigits: 0
                });
                axios
                    .get(this.localVal + `/api/CLART/GetCLARTByART/${id}`, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoModClart = res.data;
                        this.idMod = id;
                        this.idARTMOD = this.listadoModClart[0].idART;
                        this.seleccionEstados.id = this.listadoModClart[0].idEstado;
                        this.seleccionEstados.descripcionEstado = this.listadoModClart[0].descripcionEstado;
                        this.seleccionProveedor.id = this.listadoModClart[0].idProveedor;
                        this.seleccionProveedor.rutProveedor = this.listadoModClart[0].rutProveedor;
                        this.seleccionProveedor.descripcionProveedor = this.listadoModClart[0].descripcionProveedor;
                        this.fechaFactura = this.listadoModClart[0].fechaemifac;
                        this.fechaEmisionContabilidad = this.listadoModClart[0].fechaentcont;
                        this.montof = this.listadoModClart[0].monto;
                        this.monto = formatter.format(this.montof);
                        this.nfactura = this.listadoModClart[0].nfactura;
                        this.popUpdate = true;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        popBorrarRegistro(id) {
            this.popBorrarR = true;
            this.idARTEliminar = id;
        },
        popDeleteART(id) {
            try {
                let objeto = {
                    id: id
                };
                axios
                    .post(
                        this.localVal + "/api/CLART/DestroyRegistroCLART",
                        objeto,
                        {
                            headers: {
                                Authorization:
                                    `Bearer ` + sessionStorage.getItem("token")
                            }
                        }
                    )
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                title: "Realizado ",
                                text:
                                    "Registro Eliminado Correctamente, Se recargara Listado ",
                                color: "success",
                                position: "top-right"
                            });
                            this.popBorrarR = false;
                            this.cargarCLART();
                        } else {
                            this.$vs.notify({
                                title: "Error ",
                                text: "No fue posible eliminar el registro ",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    });
            } catch (error) {
                this.$vs.notify({
                    title: "Error ",
                    text: "Hubo un problema al tratar de eliminar el registro ",
                    color: "danger",
                    position: "top-right"
                });
            }
        },
        getImage(event) {
            //Asignamos la imagen a  nuestra data
            this.image = event.target.files[0];
            this.desDoc = this.image.name;
        },
        cambiarEstado(idART) {
            this.idARTEstado = idART;
            this.popEstado = true;
            this.seleccionEstados = {
                id: 1,
                descripcionEstado: "Ingresado"
            };
        },
        guardarCambioEstado() {
            try {
                if (this.seleccionEstados.id == 4) {
                    let fecha = moment().format("YYYY-MM-DD");
                    let data = {
                        idART: this.idARTEstado,
                        idEstado: this.seleccionEstados.id,
                        fechaEmisionContabilidad: fecha
                    };
                    axios
                        .post(
                            this.localVal +
                                "/api/CLART/PUTCambiarEstadoContabilidad",
                            data,
                            {
                                headers: {
                                    Authorization:
                                        `Bearer ` +
                                        sessionStorage.getItem("token")
                                }
                            }
                        )
                        .then(response => {
                            let resp = response.data;
                            if (resp == true) {
                                this.$vs.notify({
                                    title: "Estado Cambiado ",
                                    text: "Se recargaran Listados ",
                                    color: "success",
                                    position: "top-right"
                                });
                                this.cargarCLART();
                                this.popEstado = false;
                            } else {
                                this.$vs.notify({
                                    title: "Error al cambiar Estado  ",
                                    text: "Intente nuevamente  ",
                                    color: "danger",
                                    position: "top-right"
                                });
                            }
                        });
                } else {
                    let data = {
                        idART: this.idARTEstado,
                        idEstado: this.seleccionEstados.id
                    };
                    axios
                        .post(
                            this.localVal + "/api/CLART/PUTCambiarEstado",
                            data,
                            {
                                headers: {
                                    Authorization:
                                        `Bearer ` +
                                        sessionStorage.getItem("token")
                                }
                            }
                        )
                        .then(response => {
                            let resp = response.data;
                            if (resp == true) {
                                this.$vs.notify({
                                    title: "Estado Cambiado ",
                                    text: "Se recargaran Listados ",
                                    color: "success",
                                    position: "top-right"
                                });
                                this.cargarCLART();
                                this.popEstado = false;
                            } else {
                                this.$vs.notify({
                                    title: "Error al cambiar Estado  ",
                                    text: "Intente nuevamente  ",
                                    color: "danger",
                                    position: "top-right"
                                });
                            }
                        });
                }
            } catch (error) {
                console.log(error);
            }
        },
        uploadImage() {
            //Creamos el formData
            var data = new FormData();
            //Añadimos la imagen seleccionada
            data.append("avatar", this.image);
            data.append("id", this.idART);
            data.append("nombreDoc", this.desDoc);
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
                    .get(this.localVal + "/api/CLART/GetRegistroCLARTS", {
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
                            let fecha = moment(value.updated_at).format(
                                "YYYY-MM-DD"
                            );
                            value.updated_at = fecha;
                            value.monto = formatter.format(value.monto);
                            b.push(value);
                        });

                        this.listadoCLART = b;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarEstados() {
            try {
                axios
                    .get(this.localVal + "/api/CLART/GetEstados", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoEstados = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        //Lado Pop Update
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

                this.montof = this.monto;
                this.monto = formatter.format(this.montof);
            } catch (error) {
                console.log(error);
            }
        },
        retornarMonto() {
            try {
                this.monto = this.montof;
            } catch (error) {
                console.log(error);
            }
        },
        //Fin de Conversor
        //Subir Documentos
        getImage(event) {
            //Asignamos la imagen a  nuestra data
            this.image = event.target.files[0];
            this.desDoc = this.image.name;
        },
        modificarCLART() {
            try {
                if (this.idARTMOD == null || this.idARTMOD == "") {
                    this.$vs.notify({
                        title: "Error ",
                        text: "Campo ART no debe quedar en blanco ",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (
                    this.seleccionProveedor.id == 0 ||
                    this.seleccionProveedor.id == null
                ) {
                    this.$vs.notify({
                        title: "Error ",
                        text: "Proveedor no Seleccionado ",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (
                    this.seleccionEstados.id == 0 ||
                    this.seleccionEstados.id == null
                ) {
                    this.$vs.notify({
                        title: "Error ",
                        text: "Estado no Seleccionado ",
                        color: "danger",
                        position: "top-right"
                    });
                } else if (this.montof == 0 || this.montof == null) {
                    this.$vs.notify({
                        title: "Error ",
                        text: "Monto no debe quedar en blanco ",
                        color: "danger",
                        position: "top-right"
                    });
                } else {
                    let objeto = {
                        id: this.idMod,
                        idART: this.idARTMOD,
                        idProveedor: this.seleccionProveedor.id,
                        idEstado: this.seleccionEstados.id,
                        monto: this.montof,
                        nfactura: this.nfactura,
                        fechaemifac: this.fechaFactura,
                        fechaentcont: this.fechaEmisionContabilidad
                        //idCategoria: 3,
                        //idEstado: this.seleccionEstados.id
                    };

                    const dat = objeto;

                    axios
                        .all([
                            axios.post(
                                this.localVal + "/api/CLART/PUTRegistroCLART",
                                dat,
                                {
                                    headers: {
                                        Authorization:
                                            `Bearer ` +
                                            sessionStorage.getItem("token")
                                    }
                                }
                            )
                        ])
                        .then(
                            axios.spread(res1 => {
                                let resp1 = res1.data;

                                if (resp1 == true) {
                                    this.$vs.notify({
                                        title: "Registro Modificado ",
                                        text:
                                            "Podra Visualizarlo en el listado que se recargara a continuacion",
                                        color: "success",
                                        position: "top-right"
                                    });
                                    this.cargarCLART();
                                    this.popUpdate = false;
                                } else {
                                    this.$vs.notify({
                                        title: "Error al guardar registro ",
                                        text: "Intente nuevamente ",
                                        color: "danger",
                                        position: "top-right"
                                    });
                                }
                            })
                        );
                }
                //Data en objeto para Registro
            } catch (error) {
                console.log(error);
            }
        },
        //Fin Subir Documentos
        //Carga Listados
        cargarProveedores() {
            try {
                axios
                    .get(this.localVal + "/api/CLART/GetProveedores", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoProveedores = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        //Fin carga Listados
        //Eliminar Documentos Listados
        popConfirmacionEliminacionDocumento(id) {
            this.popDeleteDoc = true;
            this.popVerDoc = false;
            this.idDelDoc = id;
        },
        deleteDocumento() {
            try {
                let objeto = {
                    id: this.idDelDoc
                };
                axios
                    .post(
                        this.localVal + "/api/CLART/DestroyDocRegCLART",
                        objeto,
                        {
                            headers: {
                                Authorization:
                                    `Bearer ` + sessionStorage.getItem("token")
                            }
                        }
                    )
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                title: "Realizado ",
                                text: "Documento Eliminado Correctamente ",
                                color: "success",
                                position: "top-right"
                            });
                            this.popDeleteDoc = false;
                        } else {
                            this.$vs.notify({
                                title: "Error ",
                                text: "No fue posible eliminar el documento ",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    });
            } catch (error) {
                this.$vs.notify({
                    title: "Error ",
                    text:
                        "Hubo un problema al tratar de eliminar el documento ",
                    color: "danger",
                    position: "top-right"
                });
            }
        }
    },
    created: function() {
        this.cargarCLART();
        this.cargarEstados();
        this.cargarProveedores();
    }
};
</script>
<style>
.con-vs-popup .vs-popup {
    width: 900px;
}
</style>
