<template>
    <vs-row>
        <div class="vx-col md:w-1/1 w-full mb-base">
            <vx-card title="Llenar formulario con datos existentes">
                <div class="vx-row mb-4">
                    <div class="vx-col w-1/2 mt-5">
                        <h6>ID Art:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            v-model="idART"
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
                            v-model="seleccionProveedor.descripcionProveedor"
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
                            @input="validarFechaEntCont()"
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
                    <div class="vx-col w-1/2 mt-5" v-show="verFechaEntregaCont">
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
                    <div class="vx-col w-1/3 mt-5">
                        <vs-button class="fixedHeight w-full" color="primary"
                            >Volver</vs-button
                        >
                    </div>
                    <div class="vx-col w-1/3 mt-5">
                        <vs-button
                            class="w-full"
                            color="warning"
                            @click="limpiar()"
                            >Limpiar Campos</vs-button
                        >
                    </div>
                    <div class="vx-col w-1/3 mt-5">
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
import { validate, clean, format } from "rut.js";
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
            seleccionProveedor: {
                id: 0,
                rutProveedor: "",
                descripcionProveedor: ""
            },
            seleccionEstados: {
                id: 1,
                descripcionEstado: "Ingresado"
            },
            fechaEmisionContabilidad: "",
            fechaFactura: moment().format("YYYY-MM-DD"),
            image: "",
            value3: "",
            idART: "",
            monto: 0,
            montof: 0,
            nfactura: "",
            listadoProveedores: [],
            listadoEstados: [],
            localVal: process.env.MIX_APP_URL,
            desDoc: "",
            verFechaEntregaCont: false,
            rutProveedorN: "",
            descripcionProveedorN: "",
            popProveedor: false,
            val_run: false
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
        limpiar() {
            this.seleccionProveedor = {
                id: 0,
                rutProveedor: "",
                descripcionProveedor: ""
            };
            this.seleccionEstados = {
                id: 1,
                descripcionEstado: "Ingresado"
            };
            this.monto = 0;
            this.montof = 0;
            this.nfactura = "";
            this.image = "";
            this.idART = "";
            this.fechaFactura = moment().format("YYYY-MM-DD");
        },
        //Proveedor
        popAbrirProveedor() {
            try {
                if (
                    this.seleccionProveedor.id == 0 ||
                    this.seleccionProveedor.id == null
                ) {
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
                    console.log(this.rutProveedorN);
                    console.log(this.descripcionProveedorN);
                    this.$vs.notify({
                        title: "Error ",
                        text:
                            "Rut o Descripcion Proveedor no Ingresados, verifique y intente nuevamente ",
                        color: "danger",
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
        //Mostrar Calendario
        validarFechaEntCont() {
            try {
                if (this.seleccionEstados.id == 4) {
                    this.fechaEmisionContabilidad = moment().format(
                        "YYYY-MM-DD"
                    );
                    this.verFechaEntregaCont = true;
                } else {
                    this.fechaEmisionContabilidad = "";
                    this.verFechaEntregaCont = false;
                }
            } catch (error) {
                console.log(error);
            }
        },
        //Fin Mostrar Calendario
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
        guardarCLART() {
            try {
                if (this.idART == null || this.idART == "") {
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
                    if (
                        this.imagen == "" ||
                        this.imagen == null ||
                        this.imagen == 0
                    ) {
                        if (this.seleccionEstados.id == 4) {
                            //Data en objeto para Registro
                            let objeto = {
                                idART: this.idART,
                                idProveedor: this.seleccionProveedor.id,
                                monto: this.montof,
                                nfactura: this.nfactura,
                                fechaemifac: this.fechaFactura,
                                fechaentcont: this.fechaEmisionContabilidad,
                                idCategoria: 3,
                                idEstado: this.seleccionEstados.id
                            };

                            const dat = objeto;

                            axios
                                .all([
                                    axios.post(
                                        this.localVal +
                                            "/api/CLART/PostRegistroCLART",
                                        dat,
                                        {
                                            headers: {
                                                Authorization:
                                                    `Bearer ` +
                                                    sessionStorage.getItem(
                                                        "token"
                                                    )
                                            }
                                        }
                                    )
                                ])
                                .then(
                                    axios.spread(res2 => {
                                        let resp2 = res2.data;

                                        if (resp2 == true) {
                                            this.$vs.notify({
                                                title: "Registro Guardado ",
                                                text:
                                                    "Podra Visualizarlo en el menu del costado en el listado de ART ingresados ",
                                                color: "success",
                                                position: "top-right"
                                            });
                                            this.limpiar();
                                            this.popupActive3 = false;
                                        } else {
                                            this.$vs.notify({
                                                title:
                                                    "Error al guardar registro ",
                                                text: "Intente nuevamente ",
                                                color: "danger",
                                                position: "top-right"
                                            });
                                        }
                                    })
                                );
                        } else {
                            //Data en objeto para Registro
                            let objeto = {
                                idART: this.idART,
                                idProveedor: this.seleccionProveedor.id,
                                monto: this.montof,
                                nfactura: this.nfactura,
                                fechaemifac: this.fechaFactura,
                                idCategoria: 3,
                                idEstado: this.seleccionEstados.id
                            };

                            const dat = objeto;

                            axios
                                .all([
                                    axios.post(
                                        this.localVal +
                                            "/api/CLART/PostRegistroCLART",
                                        dat,
                                        {
                                            headers: {
                                                Authorization:
                                                    `Bearer ` +
                                                    sessionStorage.getItem(
                                                        "token"
                                                    )
                                            }
                                        }
                                    )
                                ])
                                .then(
                                    axios.spread(res2 => {
                                        let resp2 = res2.data;

                                        if (resp2 == true) {
                                            this.$vs.notify({
                                                title: "Registro Guardado ",
                                                text:
                                                    "Podra Visualizarlo en el menu del costado en el listado de ART ingresados ",
                                                color: "success",
                                                position: "top-right"
                                            });
                                            this.limpiar();
                                            this.popupActive3 = false;
                                        } else {
                                            this.$vs.notify({
                                                title:
                                                    "Error al guardar registro ",
                                                text: "Intente nuevamente ",
                                                color: "danger",
                                                position: "top-right"
                                            });
                                        }
                                    })
                                );
                        }
                    } else {
                        if (this.seleccionEstados.id == 4) {
                            //Creamos el formData
                            var data = new FormData();
                            //Añadimos la imagen seleccionada
                            data.append("avatar", this.image);
                            data.append("id", this.idART);
                            data.append("nombreDoc", this.desDoc);

                            //Data en objeto para Registro
                            let objeto = {
                                idART: this.idART,
                                idProveedor: this.seleccionProveedor.id,
                                monto: this.montof,
                                nfactura: this.nfactura,
                                fechaemifac: this.fechaFactura,
                                fechaentcont: this.fechaEmisionContabilidad,
                                idCategoria: 3,
                                idEstado: this.seleccionEstados.id
                            };

                            const dat = objeto;

                            axios
                                .all([
                                    axios.post(
                                        this.localVal +
                                            "/api/CLART/PostDocumentoF",
                                        data,
                                        {
                                            headers: {
                                                Authorization:
                                                    `Bearer ` +
                                                    sessionStorage.getItem(
                                                        "token"
                                                    )
                                            }
                                        }
                                    ),
                                    axios.post(
                                        this.localVal +
                                            "/api/CLART/PostRegistroCLART",
                                        dat,
                                        {
                                            headers: {
                                                Authorization:
                                                    `Bearer ` +
                                                    sessionStorage.getItem(
                                                        "token"
                                                    )
                                            }
                                        }
                                    )
                                ])
                                .then(
                                    axios.spread((res1, res2) => {
                                        let resp1 = res1.data;
                                        let resp2 = res2.data;

                                        if (resp1 == true && resp2 == true) {
                                            this.$vs.notify({
                                                title: "Registro Guardado ",
                                                text:
                                                    "Podra Visualizarlo en el menu del costado para descargarlo o visualizarlo en el navegador ",
                                                color: "success",
                                                position: "top-right"
                                            });
                                            this.limpiar();
                                            this.popupActive3 = false;
                                        } else {
                                            this.$vs.notify({
                                                title:
                                                    "Error al guardar registro ",
                                                text: "Intente nuevamente ",
                                                color: "danger",
                                                position: "top-right"
                                            });
                                        }
                                    })
                                );
                        } else {
                            //Creamos el formData
                            var data = new FormData();
                            //Añadimos la imagen seleccionada
                            data.append("avatar", this.image);
                            data.append("id", this.idART);
                            data.append("nombreDoc", this.desDoc);

                            //Data en objeto para Registro
                            let objeto = {
                                idART: this.idART,
                                idProveedor: this.seleccionProveedor.id,
                                monto: this.montof,
                                nfactura: this.nfactura,
                                fechaemifac: this.fechaFactura,
                                idCategoria: 3,
                                idEstado: this.seleccionEstados.id
                            };

                            const dat = objeto;

                            axios
                                .all([
                                    axios.post(
                                        this.localVal +
                                            "/api/CLART/PostDocumentoF",
                                        data,
                                        {
                                            headers: {
                                                Authorization:
                                                    `Bearer ` +
                                                    sessionStorage.getItem(
                                                        "token"
                                                    )
                                            }
                                        }
                                    ),
                                    axios.post(
                                        this.localVal +
                                            "/api/CLART/PostRegistroCLART",
                                        dat,
                                        {
                                            headers: {
                                                Authorization:
                                                    `Bearer ` +
                                                    sessionStorage.getItem(
                                                        "token"
                                                    )
                                            }
                                        }
                                    )
                                ])
                                .then(
                                    axios.spread((res1, res2) => {
                                        let resp1 = res1.data;
                                        let resp2 = res2.data;

                                        if (resp1 == true && resp2 == true) {
                                            this.$vs.notify({
                                                title: "Registro Guardado ",
                                                text:
                                                    "Podra Visualizarlo en el menu del costado para descargarlo o visualizarlo en el navegador ",
                                                color: "success",
                                                position: "top-right"
                                            });
                                            this.limpiar();
                                            this.popupActive3 = false;
                                        } else {
                                            this.$vs.notify({
                                                title:
                                                    "Error al guardar registro ",
                                                text: "Intente nuevamente ",
                                                color: "danger",
                                                position: "top-right"
                                            });
                                        }
                                    })
                                );
                        }
                    }
                }
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
        }
        //Fin carga Listados
    },
    created: function() {
        this.cargarProveedores();
        this.cargarEstados();
    }
};
</script>
