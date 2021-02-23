<template>
    <vs-row>
        <div class="vx-col md:w-1/1 w-full mb-base">
            <vx-card title="Llenar formulario con datos existentes">
                <div class="vx-row mb-4">
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Buscar por N° ART Existente:</h6>
                        <br />
                        <vs-input class="inputx w-full"></vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Buscar por N° OC Existente:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            taggable
                            label="descripcionOrdenCompras"
                            v-model="seleccionOrdenCompraForAPI"
                            :options="listadoOrdenComprasData"
                            @input="cargarAPIByOC"
                        ></v-select>
                    </div>
                </div>
            </vx-card>
            <br />
            <vx-card title="">
                <div class="vx-row mb-4">
                    <div class="vx-col w-1/3 mt-5">
                        <h6>N° ART:</h6>
                        <br />
                        <vs-input class="inputx w-full"> </vs-input>
                    </div>
                    <div class="vx-col w-1/3 mt-5">
                        <h6>Fecha ART</h6>
                        <br />
                        <flat-pickr
                            :config="configFromdateTimePicker"
                            v-model="fechaART"
                            placeholder="Fecha ART"
                            @on-change="onFromChange"
                            class="w-full"
                        />
                    </div>
                    <div class="vx-col w-1/3 mt-5">
                        <h6>Fecha Factura</h6>
                        <br />
                        <flat-pickr
                            :config="configTodateTimePicker"
                            v-model="fechaFactura"
                            placeholder="Fecha Factura"
                            @on-change="onToChange"
                            class="w-full"
                        />
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Rut Proveedor</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            v-model="seleccionProveedores"
                            label="rutProveedor"
                            :options="listadoProveedores"
                            @on-change="seleccionDescripcionProveedor"
                            taggable
                            @input="popProveedor"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Descripcion Proveedor:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            v-model="seleccionProveedores.descripcionProveedor"
                            readonly
                        >
                        </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Solicitante:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionSolicitante"
                            v-model="seleccionSolicitantes"
                            :options="listadoSolicitantes"
                            taggable
                            @input="popNSolicitante"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Ejecutor:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionEjecutores"
                            v-model="seleccionEjecutor"
                            :options="listadoEjecutores"
                            taggable
                            @input="popNEjecutor"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Item Presupuestario:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="codigoItemPresupuestario"
                            v-model="seleccionItemPresupuestario"
                            :options="listadoItemPresupuestario"
                            @on-change="selecciondescripcionIP"
                            taggable
                            @input="popNIP"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Descripcion Item Presupuestario:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            readonly
                            v-model="
                                seleccionItemPresupuestario.descripcionItemPresupuestario
                            "
                        >
                        </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Tipo Mantencion:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionTipoMantencion"
                            v-model="seleccionTipoMantencion"
                            :options="listadoTipoMantencion"
                            taggable
                            @input="popNTM"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Recurso:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionRecursos"
                            v-model="seleccionRecursos"
                            :options="listadoRecursos"
                            taggable
                            @input="popNR"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Tipo Compra:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionTipoCompra"
                            v-model="seleccionTipoCompra"
                            :options="listadoTipoCompra"
                            taggable
                            @input="popNTC"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Licitacion:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="codigoLicitacion"
                            v-model="seleccionLicitaciones"
                            :options="listadoLicitaciones"
                            taggable
                            @input="popNL"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Resolucion Llamados:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionResLlamados"
                            v-model="seleccionResolucionLlamado"
                            :options="listadoResolucionLlamados"
                            taggable
                            @input="popRL"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Resolucion Adjudicacion:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionResAdj"
                            v-model="seleccionResolucionAdjudicaciones"
                            :options="listadoResolucionAdjudicaciones"
                            taggable
                            @input="popRA"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Resolucion Contrato:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionResContratos"
                            v-model="seleccionResolucionContrato"
                            :options="listadoResolucionContrato"
                            taggable
                            @input="popRC"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° CDP:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionCDPS"
                            v-model="seleccionCDP"
                            :options="listadoCDP"
                            taggable
                            @input="popCDP"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Orden de Compra:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionOrdenCompras"
                            v-model="seleccionOrdenCompra"
                            :options="listadoOrdenCompras"
                            taggable
                            @input="popOC"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Resolucion Interna:</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionResInternas"
                            v-model="seleccionResolucionInterna"
                            :options="listadoResolucionInterna"
                            taggable
                            @input="popRI"
                        ></v-select>
                    </div>
                    <div class="vx-col w-full mt-5">
                        <h6>N° Memo</h6>
                        <br />
                        <v-select
                            class="w-full select-large"
                            label="descripcionMemo"
                            v-model="seleccionMemo"
                            :options="listadoMemos"
                            taggable
                            @input="popM"
                        ></v-select>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Monto:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            v-model="montoART"
                            @blur="convertirMonto"
                            @focus="retornarMonto"
                            @keypress="isNumber($event)"
                        >
                        </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Cuota:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            v-model="cuotaART"
                            @keypress="isNumber($event)"
                        >
                        </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>Saldo:</h6>
                        <br />
                        <vs-input
                            class="inputx w-full"
                            v-model="saldoART"
                            @blur="convertirSaldo"
                            @focus="retornarSaldo"
                            @keypress="isNumber($event)"
                        >
                        </vs-input>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <h6>N° Factura:</h6>
                        <br />
                        <vs-input class="inputx w-full" v-model="nfacturaART">
                        </vs-input>
                    </div>
                    <div class="vx-col w-full mt-5">
                        <h6>Detalle ART</h6>
                        <br />
                        <quill-editor
                            class="w-full"
                            v-model="descripcionART"
                            :options="editorOption"
                        >
                            <div id="toolbar" slot="toolbar"></div>
                        </quill-editor>
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
                            @click="popART"
                            >Guardar</vs-button
                        >
                    </div>
                </div>
            </vx-card>
        </div>
        <!-- Pop Solicitante -->
        <vs-popup
            classContent="pop-CrearSolicitante"
            title="Crear Nuevo Solicitante"
            :active.sync="popCrearSolicitante"
            ><vs-input class="inputx mb-3" v-model="desSolicitante" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoSolicitante(desSolicitante)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearSolicitante = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Ejecutor -->
        <vs-popup
            classContent="pop-Ejecutor"
            title="Crear Nuevo Ejecutor"
            :active.sync="popCrearEjecutor"
            ><vs-input class="inputx mb-3" v-model="desEjecutor" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoEjecutor(desEjecutor)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearEjecutor = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Item Presupuestario -->
        <vs-popup
            classContent="pop-ItemPresupuestario"
            title="Crear Item Presupuestario"
            :active.sync="popCrearIP"
        >
            <div class="vx-col w-full">
                <div class="vx-row">
                    <div class="vx-col w-full mt-5">
                        <h6>Codigo Item Presupuestario:</h6>
                        <br />
                        <vs-input class="w-full" v-model="codIP" />
                    </div>
                    <div class="vx-col w-full mt-5">
                        <h6>Descripcion Item Presupuestario:</h6>
                        <br />
                        <vs-input class="w-full" v-model="desIP" />
                    </div>
                    <br />
                    <div class="vx-col w-1/2 mt-5">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full"
                            @click="
                                guardarNuevoItemPresupuestario(codIP, desIP)
                            "
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <vs-button
                            class="w-full"
                            @click="popCrearIP = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Tipo Mantencion -->
        <vs-popup
            classContent="pop-TipoMantencion"
            title="Crear Tipo Mantencion"
            :active.sync="popCrearTM"
            ><vs-input class="inputx mb-3" v-model="desTM" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoTM(desTM)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearTM = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Recurso -->
        <vs-popup
            classContent="pop-CrearRecurso"
            title="Crear Recurso"
            :active.sync="popCrearR"
            ><vs-input class="inputx mb-3" v-model="desR" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoR(desR)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearR = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Tipo Compra -->
        <vs-popup
            classContent="pop-TipoCompra"
            title="Crear Tipo Compra"
            :active.sync="popCrearTC"
            ><vs-input class="inputx mb-3" v-model="desTC" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoTC(desTC)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearTC = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Licitacion -->
        <vs-popup
            classContent="pop-Licitacion"
            title="Crear N° Licitacion"
            :active.sync="popCrearL"
            ><vs-input class="inputx mb-3" v-model="desL" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoL(desL)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearL = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Resolucion Llamado -->
        <vs-popup
            classContent="pop-ResLla"
            title="Crear N° Resolucion Llamado"
            :active.sync="popCrearRL"
            ><vs-input class="inputx mb-3" v-model="desRL" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoRL(desRL)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearRL = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Resolucion Adjudicacion -->
        <vs-popup
            classContent="pop-ResAdj"
            title="Crear N° Resolucion Adjudicacion"
            :active.sync="popCrearRA"
            ><vs-input class="inputx mb-3" v-model="desRA" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoRA(desRA)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearRA = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Resolucion Contratos -->
        <vs-popup
            classContent="pop-ResCon"
            title="Crear N° Resolucion Contratos"
            :active.sync="popCrearRC"
            ><vs-input class="inputx mb-3" v-model="desRC" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoRC(desRC)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearRC = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop CDP -->
        <vs-popup
            classContent="pop-CDP"
            title="Crear N° CDP"
            :active.sync="popCrearCDP"
            ><vs-input class="inputx mb-3" v-model="desCDP" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoCDP(desCDP)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearCDP = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Orden de Compra -->
        <vs-popup
            classContent="pop-OC"
            title="Crear N° Orden de Compra"
            :active.sync="popCrearOC"
            ><vs-input class="inputx mb-3" v-model="desOC" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoOC(desOC)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearOC = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Resolucion Interna -->
        <vs-popup
            classContent="pop-RI"
            title="Crear N° Resolucion Interna"
            :active.sync="popCrearRI"
            ><vs-input class="inputx mb-3" v-model="desRI" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoRI(desRI)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearRI = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Memo -->
        <vs-popup
            classContent="pop-Memo"
            title="Crear N° Memo"
            :active.sync="popCrearM"
            ><vs-input class="inputx mb-3" v-model="desM" hidden />
            <div class="vx-col md:w-1/1 w-full mb-base">
                <div class="vx-row">
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full m-2"
                            @click="guardarNuevoMemo(desM)"
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col sm:w-full w-full">
                        <vs-button
                            class="w-full m-2"
                            @click="popCrearM = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
                </div>
            </div>
        </vs-popup>
        <!-- Pop Proveedor -->
        <vs-popup
            classContent="pop-Proveedor"
            title="Crear Proveedor"
            :active.sync="popCrearProveedor"
        >
            <div class="vx-col w-full">
                <div class="vx-row">
                    <div class="vx-col w-full mt-5">
                        <h6>Rut Proveedor:</h6>
                        <br />
                        <vs-input class="w-full" v-model="rutProveedor" />
                    </div>
                    <div class="vx-col w-full mt-5">
                        <h6>Descripcion Proveedor:</h6>
                        <br />
                        <vs-input class="w-full" v-model="desProveedor" />
                    </div>
                    <br />
                    <div class="vx-col w-1/2 mt-5">
                        <vs-button
                            color="warning"
                            type="filled"
                            class="w-full"
                            @click="
                                guardarProveedor(rutProveedor, desProveedor)
                            "
                        >
                            Guardar
                        </vs-button>
                    </div>
                    <div class="vx-col w-1/2 mt-5">
                        <vs-button
                            class="w-full"
                            @click="popCrearProveedor = false"
                            color="primary"
                            type="filled"
                            >Volver</vs-button
                        >
                    </div>
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
            popCrearSolicitante: false,
            popCrearEjecutor: false,
            popCrearIP: false,
            popCrearTM: false,
            popCrearR: false,
            popCrearTC: false,
            popCrearL: false,
            popCrearRL: false,
            popCrearRA: false,
            popCrearRC: false,
            popCrearCDP: false,
            popCrearOC: false,
            popCrearRI: false,
            popCrearM: false,
            popCrearProveedor: false,
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
            fechaART: new Date(),
            fechaFactura: new Date(),
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
            listadoCDP: [],
            listadoEjecutores: [],
            listadoItemPresupuestario: [],
            listadoLicitaciones: [],
            listadoMemos: [],
            listadoOrdenCompras: [],
            listadoOrdenComprasData: [],
            listadoProveedores: [],
            listadoRecursos: [],
            listadoResolucionAdjudicaciones: [],
            listadoResolucionContrato: [],
            listadoResolucionInterna: [],
            listadoResolucionLlamados: [],
            listadoSolicitantes: [],
            listadoTipoCompra: [],
            listadoTipoMantencion: [],
            seleccionCDP: {
                id: 0,
                descripcionCDPS: ""
            },
            seleccionEjecutor: {
                id: 0,
                descripcionEjecutores: ""
            },
            seleccionItemPresupuestario: {
                id: 0,
                codigoItemPresupuestario: "",
                descripcionItemPresupuestario: ""
            },
            seleccionLicitaciones: {
                id: 0,
                codigoLicitacion: ""
            },
            seleccionMemo: {
                id: 0,
                descripcionMemo: ""
            },
            seleccionOrdenCompra: {
                id: 0,
                descripcionOrdenCompras: "",
                fecha_oc: new Date(),
                idEstadoOC: 0
            },
            seleccionOrdenCompraForAPI: {
                id: 0,
                descripcionOrdenCompras: "",
                fecha_oc: new Date(),
                idEstadoOC: 0
            },
            seleccionProveedores: {
                id: 0,
                rutProveedor: "",
                descripcionProveedor: ""
            },
            seleccionRecursos: {
                id: 0,
                descripcionRecursos: ""
            },
            seleccionResolucionAdjudicaciones: {
                id: 0,
                descripcionResAdj: ""
            },
            seleccionResolucionContrato: {
                id: 0,
                descripcionResContratos: ""
            },
            seleccionResolucionInterna: {
                id: 0,
                descripcionResInternas: ""
            },
            seleccionResolucionLlamado: {
                id: 0,
                descripcionResLlamados: ""
            },
            seleccionSolicitantes: {
                id: 0,
                descripcionSolicitante: ""
            },
            seleccionTipoCompra: {
                id: 0,
                descripcionTipoCompra: ""
            },
            seleccionTipoMantencion: {
                id: 0,
                descripcionTipoMantencion: ""
            },
            descripcionART: "",
            montoART: 0,
            montoData: 0,
            cuotaART: 0,
            saldoART: 0,
            saldoData: 0,
            nfacturaART: 0,
            desSolicitante: "",
            desEjecutor: "",
            codIP: "",
            desIP: "",
            desTM: "",
            desR: "",
            desTC: "",
            desL: "",
            desRL: "",
            desRA: "",
            desRC: "",
            desCDP: "",
            desOC: "",
            desRI: "",
            desM: "",
            rutProveedor: "",
            desProveedor: "",
            localVal: process.env.MIX_APP_URL
        };
    },
    methods: {
        //Apertura de Pops
        popNSolicitante() {
            try {
                if (
                    this.seleccionSolicitantes.id == 0 ||
                    this.seleccionSolicitantes.id == null
                ) {
                    if (
                        this.seleccionSolicitantes.descripcionSolicitante ===
                            undefined ||
                        this.seleccionSolicitantes.descripcionSolicitante ===
                            null ||
                        this.seleccionSolicitantes.descripcionSolicitante == ""
                    ) {
                        this.desSolicitante = this.seleccionSolicitantes;
                        this.popCrearSolicitante = true;
                    } else {
                        this.desSolicitante = this.seleccionSolicitantes.descripcionSolicitante;
                        this.popCrearSolicitante = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popNEjecutor() {
            try {
                if (
                    this.seleccionEjecutor.id == 0 ||
                    this.seleccionEjecutor.id == null
                ) {
                    if (
                        this.seleccionEjecutor.descripcionEjecutores ===
                            undefined ||
                        this.seleccionEjecutor.descripcionEjecutores === null ||
                        this.seleccionEjecutor.descripcionEjecutores == ""
                    ) {
                        this.desEjecutor = this.seleccionEjecutor;
                        this.popCrearEjecutor = true;
                    } else {
                        this.desEjecutor = this.seleccionEjecutor.descripcionEjecutores;
                        this.popCrearEjecutor = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popNIP() {
            try {
                if (
                    this.seleccionItemPresupuestario.id == 0 ||
                    this.seleccionItemPresupuestario.id == null
                ) {
                    if (
                        this.seleccionItemPresupuestario
                            .codigoItemPresupuestario === undefined ||
                        this.seleccionItemPresupuestario
                            .codigoItemPresupuestario === null ||
                        this.seleccionItemPresupuestario
                            .codigoItemPresupuestario == ""
                    ) {
                        this.codIP = this.seleccionItemPresupuestario;
                        this.popCrearIP = true;
                    } else {
                        this.codIP = this.seleccionItemPresupuestario.codigoItemPresupuestario;
                        this.popCrearIP = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popNTM() {
            try {
                if (
                    this.seleccionTipoMantencion.id == 0 ||
                    this.seleccionTipoMantencion.id == null
                ) {
                    if (
                        this.seleccionTipoMantencion
                            .descripcionTipoMantencion === undefined ||
                        this.seleccionTipoMantencion
                            .descripcionTipoMantencion === null ||
                        this.seleccionTipoMantencion
                            .descripcionTipoMantencion == ""
                    ) {
                        this.desTM = this.seleccionTipoMantencion;
                        this.popCrearTM = true;
                    } else {
                        this.desTM = this.seleccionTipoMantencion.descripcionTipoMantencion;
                        this.popCrearTM = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popNR() {
            try {
                if (
                    this.seleccionRecursos.id == 0 ||
                    this.seleccionRecursos.id == null
                ) {
                    if (
                        this.seleccionRecursos.descripcionRecursos ===
                            undefined ||
                        this.seleccionRecursos.descripcionRecursos === null ||
                        this.seleccionRecursos.descripcionRecursos == ""
                    ) {
                        this.desTM = this.seleccionRecursos;
                        this.popCrearR = true;
                    } else {
                        this.desTM = this.seleccionRecursos.descripcionRecursos;
                        this.popCrearR = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popNTC() {
            try {
                if (
                    this.seleccionTipoCompra.id == 0 ||
                    this.seleccionTipoCompra.id == null
                ) {
                    if (
                        this.seleccionTipoCompra.descripcionTipoCompra ===
                            undefined ||
                        this.seleccionTipoCompra.descripcionTipoCompra ===
                            null ||
                        this.seleccionTipoCompra.descripcionTipoCompra == ""
                    ) {
                        this.desTC = this.seleccionTipoCompra;
                        this.popCrearTC = true;
                    } else {
                        this.desTC = this.seleccionTipoCompra.descripcionTipoCompra;
                        this.popCrearTC = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popNL() {
            try {
                if (
                    this.seleccionLicitaciones.id == 0 ||
                    this.seleccionLicitaciones.id == null
                ) {
                    if (
                        this.seleccionLicitaciones.codigoLicitacion ===
                            undefined ||
                        this.seleccionLicitaciones.codigoLicitacion === null ||
                        this.seleccionLicitaciones.codigoLicitacion == ""
                    ) {
                        this.desL = this.seleccionLicitaciones;
                        this.popCrearL = true;
                    } else {
                        this.desL = this.seleccionLicitaciones.codigoLicitacion;
                        this.popCrearL = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popRL() {
            try {
                if (
                    this.seleccionResolucionLlamado.id == 0 ||
                    this.seleccionResolucionLlamado.id == null
                ) {
                    if (
                        this.seleccionResolucionLlamado
                            .descripcionResLlamados === undefined ||
                        this.seleccionResolucionLlamado
                            .descripcionResLlamados === null ||
                        this.seleccionResolucionLlamado
                            .descripcionResLlamados == ""
                    ) {
                        this.desRL = this.seleccionResolucionLlamado;
                        this.popCrearRL = true;
                    } else {
                        this.desL = this.seleccionResolucionLlamado.descripcionResLlamados;
                        this.popCrearRL = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popRA() {
            try {
                if (
                    this.seleccionResolucionAdjudicaciones.id == 0 ||
                    this.seleccionResolucionAdjudicaciones.id == null
                ) {
                    if (
                        this.seleccionResolucionAdjudicaciones
                            .descripcionResAdj === undefined ||
                        this.seleccionResolucionAdjudicaciones
                            .descripcionResAdj === null ||
                        this.seleccionResolucionAdjudicaciones
                            .descripcionResAdj == ""
                    ) {
                        this.desRL = this.seleccionResolucionAdjudicaciones;
                        this.popCrearRL = true;
                    } else {
                        this.desL = this.seleccionResolucionAdjudicaciones.descripcionResAdj;
                        this.popCrearRL = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popRC() {
            try {
                if (
                    this.seleccionResolucionContrato.id == 0 ||
                    this.seleccionResolucionContrato.id == null
                ) {
                    if (
                        this.seleccionResolucionContrato
                            .descripcionResContratos === undefined ||
                        this.seleccionResolucionContrato
                            .descripcionResContratos === null ||
                        this.seleccionResolucionContrato
                            .descripcionResContratos == ""
                    ) {
                        this.desRC = this.seleccionResolucionContrato;
                        this.popCrearRC = true;
                    } else {
                        this.desRC = this.seleccionResolucionContrato.descripcionResContratos;
                        this.popCrearRC = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popCDP() {
            try {
                if (this.seleccionCDP.id == 0 || this.seleccionCDP.id == null) {
                    if (
                        this.seleccionCDP.descripcionCDPS === undefined ||
                        this.seleccionCDP.descripcionCDPS === null ||
                        this.seleccionCDP.descripcionCDPS == ""
                    ) {
                        this.desCDP = this.seleccionCDP;
                        this.popCrearCDP = true;
                    } else {
                        this.desCDP = this.seleccionCDP.descripcionCDPS;
                        this.popCrearCDP = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popOC() {
            try {
                if (
                    this.seleccionOrdenCompra.id == 0 ||
                    this.seleccionOrdenCompra.id == null
                ) {
                    if (
                        this.seleccionOrdenCompra.descripcionOrdenCompras ===
                            undefined ||
                        this.seleccionOrdenCompra.descripcionOrdenCompras ===
                            null ||
                        this.seleccionOrdenCompra.descripcionOrdenCompras == ""
                    ) {
                        this.desOC = this.seleccionOrdenCompra;
                        this.popCrearOC = true;
                    } else {
                        this.desOC = this.seleccionOrdenCompra.descripcionOrdenCompras;
                        this.popCrearOC = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popRI() {
            try {
                if (
                    this.seleccionResolucionInterna.id == 0 ||
                    this.seleccionResolucionInterna.id == null
                ) {
                    if (
                        this.seleccionResolucionInterna
                            .descripcionResInternas === undefined ||
                        this.seleccionResolucionInterna
                            .descripcionResInternas === null ||
                        this.seleccionResolucionInterna
                            .descripcionResInternas == ""
                    ) {
                        this.desRI = this.seleccionResolucionInterna;
                        this.popCrearRI = true;
                    } else {
                        this.desRI = this.seleccionResolucionInterna.descripcionResInternas;
                        this.popCrearRI = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popM() {
            try {
                if (
                    this.seleccionMemo.id == 0 ||
                    this.seleccionMemo.id == null
                ) {
                    if (
                        this.seleccionMemo.descripcionMemo === undefined ||
                        this.seleccionMemo.descripcionMemo === null ||
                        this.seleccionMemo.descripcionMemo == ""
                    ) {
                        this.desM = this.seleccionMemo;
                        this.popCrearM = true;
                    } else {
                        this.desM = this.seleccionMemo.descripcionMemo;
                        this.popCrearM = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popProveedor() {
            try {
                if (
                    this.seleccionProveedores.id == 0 ||
                    this.seleccionProveedores.id == null
                ) {
                    if (
                        this.seleccionProveedores.rutProveedor === undefined ||
                        this.seleccionProveedores.rutProveedor === null ||
                        this.seleccionProveedores.rutProveedor == ""
                    ) {
                        this.rutProveedor = this.seleccionProveedores;
                        this.popCrearProveedor = true;
                    } else {
                        this.rutProveedor = this.seleccionProveedores.rutProveedor;
                        this.popCrearProveedor = true;
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        popART() {
            if (
                this.seleccionSolicitantes.id == 0 ||
                this.seleccionSolicitantes.id == null ||
                this.seleccionSolicitantes.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "Solicitante no Seleccionado, Seleccione algun Solicitante para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionEjecutor.id == 0 ||
                this.seleccionEjecutor.id == null ||
                this.seleccionEjecutor.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "Ejecutor no Seleccionado, Seleccione algun Ejecutor para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionItemPresupuestario.id == 0 ||
                this.seleccionItemPresupuestario.id == null ||
                this.seleccionItemPresupuestario.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "Item Presupuestario no Seleccionado, Seleccione algun Item Presupuestario para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionTipoMantencion.id == 0 ||
                this.seleccionTipoMantencion.id == null ||
                this.seleccionTipoMantencion.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "Tipo Mantencion no Seleccionado, Seleccione algun Tipo Mantencion para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionRecursos.id == 0 ||
                this.seleccionRecursos.id == null ||
                this.seleccionRecursos.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "Recursos no Seleccionado, Seleccione algun Recursos para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionTipoCompra.id == 0 ||
                this.seleccionTipoCompra.id == null ||
                this.seleccionTipoCompra.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "Tipo Compra no Seleccionado, Seleccione algun Tipo Compra para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionLicitaciones.id == 0 ||
                this.seleccionLicitaciones.id == null ||
                this.seleccionLicitaciones.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "Licitacion no Seleccionada, Seleccione alguna Licitacion para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionResolucionLlamado.id == 0 ||
                this.seleccionResolucionLlamado.id == null ||
                this.seleccionResolucionLlamado.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "N° Resolucion Llamado no Seleccionada, Seleccione algun N° Resolucion Llamado para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionResolucionAdjudicaciones.id == 0 ||
                this.seleccionResolucionAdjudicaciones.id == null ||
                this.seleccionResolucionAdjudicaciones.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "N° Resolucion Adjudicaciones no Seleccionada, Seleccione algun N° Resolucion Adjudicaciones para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionResolucionContrato.id == 0 ||
                this.seleccionResolucionContrato.id == null ||
                this.seleccionResolucionContrato.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "N° Resolucion Contrato no Seleccionado, Seleccione algun N° Resolucion Contrato para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionCDP.id == 0 ||
                this.seleccionCDP.id == null ||
                this.seleccionCDP.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "N° CDP no Seleccionado, Seleccione algun N° CDP para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionOrdenCompra.id == 0 ||
                this.seleccionOrdenCompra.id == null ||
                this.seleccionOrdenCompra.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "N° Orden Compra no Seleccionada, Seleccione algun N° Orden Compra para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionResolucionInterna.id == 0 ||
                this.seleccionResolucionInterna.id == null ||
                this.seleccionResolucionInterna.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "N° Resolucion Interna no Seleccionada, Seleccione algun N° Resolucion Interna para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionMemo.id == 0 ||
                this.seleccionMemo.id == null ||
                this.seleccionMemo.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "N° Memo no Seleccionado, Seleccione algun N° Memo para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else if (
                this.seleccionProveedores.id == 0 ||
                this.seleccionProveedores.id == null ||
                this.seleccionProveedores.id == ""
            ) {
                this.$vs.notify({
                    time: 3000,
                    title: "Error ",
                    text:
                        "Rut proveedor no seleccionado, Seleccione algun Rut proveedor para Continuar",
                    color: "danger",
                    position: "top-right"
                });
            } else {
                console.log("A");
            }
        },
        //Fin Apertura de Pops
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
        convertirSaldo() {
            try {
                const formatter = new Intl.NumberFormat("en-US", {
                    style: "currency",
                    currency: "USD",
                    minimumFractionDigits: 0
                });
                this.saldoData = this.saldoART;
                this.saldoART = formatter.format(this.saldoData);
            } catch (error) {
                console.log(error);
            }
        },
        retornarSaldo() {
            try {
                this.saldoART = this.saldoData;
            } catch (error) {
                console.log(error);
            }
        },
        //Fin de Conversor
        //Cargas de DATA Externa - Mercado Publico
        cargarAPIByOC() {
            try {
                let id = this.seleccionOrdenCompraForAPI
                    .descripcionOrdenCompras;
                axios
                    .all([
                        axios.get(
                            this.localVal + `/api/ART/GetDataByOC/${id}`,
                            {
                                headers: {
                                    Authorization:
                                        `Bearer ` +
                                        sessionStorage.getItem("token")
                                }
                            }
                        ),
                        axios.get(
                            "http://api.mercadopublico.cl/servicios/v1/publico/ordenesdecompra.json?codigo=" +
                                id +
                                "&ticket=F8537A18-6766-4DEF-9E59-426B4FEE2844",
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
                        axios.spread((res1, res2) => {
                            const formatter = new Intl.NumberFormat("en-US", {
                                style: "currency",
                                currency: "USD",
                                minimumFractionDigits: 0
                            });
                            let lista = res1.data;
                            let count = lista.length;
                            if (count > 1) {
                                console.log(lista);
                            } else {
                                let list = res2.data;
                                console.log(list);
                                this.descripcionART =
                                    list.Listado[0].Items.Listado[0].EspecificacionProveedor;
                                let monto = list.Listado[0].Total;
                                let cantidad =
                                    list.Listado[0].Items.Listado[0].Cantidad;
                                if (cantidad == 1) {
                                    this.montoData = monto;
                                    this.montoART = formatter.format(
                                        this.montoData
                                    );
                                } else if (cantidad > 1) {
                                    let valorCalculado = monto / cantidad;
                                    valorCalculado = Math.round(valorCalculado);
                                    this.montoData = valorCalculado;
                                    this.montoART = formatter.format(
                                        this.montoData
                                    );
                                }

                                let idOC = list.Listado[0].Codigo;
                                let listOC = JSON.parse(
                                    JSON.stringify(this.listadoOrdenCompras)
                                );

                                listOC.forEach((value, index) => {
                                    if (idOC == value.descripcionOrdenCompras) {
                                        this.seleccionOrdenCompra.id = value.id;
                                        this.seleccionOrdenCompra.descripcionOrdenCompras =
                                            value.descripcionOrdenCompras;
                                    }
                                });

                                let listProv = JSON.parse(
                                    JSON.stringify(this.listadoProveedores)
                                );
                                let rutProv =
                                    list.Listado[0].Proveedor.RutSucursal;
                                listProv.forEach((value, index) => {
                                    if (rutProv == value.rutProveedor) {
                                        this.seleccionProveedores.id = value.id;
                                        this.seleccionProveedores.rutProveedor =
                                            value.rutProveedor;
                                        this.seleccionProveedores.descripcionProveedor =
                                            value.descripcionProveedor;
                                    }
                                });

                                let codigoIP = list.Listado[0].Financiamiento;
                                let listIP = JSON.parse(
                                    JSON.stringify(
                                        this.listadoItemPresupuestario
                                    )
                                );
                                listIP.forEach((value, index) => {
                                    if (
                                        codigoIP ==
                                        value.codigoItemPresupuestario
                                    ) {
                                        this.seleccionItemPresupuestario.id =
                                            value.id;
                                        this.seleccionItemPresupuestario.codigoItemPresupuestario =
                                            value.codigoItemPresupuestario;
                                        this.seleccionItemPresupuestario.descripcionItemPresupuestario =
                                            value.descripcionItemPresupuestario;
                                    }
                                });

                                let codLic = list.Listado[0].CodigoLicitacion;
                                let contador = codLic.length;
                                if (contador > 1) {
                                    let listLic = JSON.parse(
                                        JSON.stringify(this.listadoLicitaciones)
                                    );
                                    listLic.forEach((value, index) => {
                                        if (codLic == value.codigoLicitacion) {
                                            this.seleccionLicitaciones.id =
                                                value.id;
                                            this.seleccionLicitaciones.codigoLicitacion =
                                                value.codigoLicitacion;
                                        }
                                    });
                                    this.cargarByIDLicitacion(codLic);
                                }
                            }
                        })
                    )
                    .catch(error => {
                        // Error 😨
                        if (error.response) {
                            /*
                             * The request was made and the server responded with a
                             * status code that falls out of the range of 2xx
                             */
                            console.log(error.response.data);
                            console.log(error.response.status);
                            console.log(error.response.headers);
                        } else if (error.request) {
                            /*
                             * The request was made but no response was received, `error.request`
                             * is an instance of XMLHttpRequest in the browser and an instance
                             * of http.ClientRequest in Node.js
                             */
                            console.log(error.request);
                        } else {
                            // Something happened in setting up the request and triggered an Error
                            console.log("Error", error.message);
                        }
                        console.log(error.config);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarByIDLicitacion(codLicitacion) {
            try {
                axios
                    .get(
                        "http://api.mercadopublico.cl/servicios/v1/publico/licitaciones.json?codigo=" +
                            codLicitacion +
                            "&ticket=F8537A18-6766-4DEF-9E59-426B4FEE2844",
                        {
                            headers: {
                                Authorization:
                                    `Bearer ` + sessionStorage.getItem("token")
                            }
                        }
                    )
                    .then(res => {
                        let list = res.data;
                        let tipoOC = list.Listado[0].Tipo;
                        let listOC = JSON.parse(
                            JSON.stringify(this.listadoTipoCompra)
                        );
                        listOC.forEach((value, index) => {
                            if (tipoOC == value.descripcionTipoCompra) {
                                this.seleccionTipoCompra.id = value.id;
                                this.seleccionTipoCompra.descripcionTipoCompra =
                                    value.descripcionTipoCompra;
                            }
                        });

                        let listResAdj = JSON.parse(
                            JSON.stringify(this.listadoResolucionAdjudicaciones)
                        );
                        let nresadj = list.Listado[0].Adjudicacion.Numero;

                        listResAdj.forEach((value, index) => {
                            if (nresadj == value.descripcionResAdj) {
                                this.seleccionResolucionAdjudicaciones.id =
                                    value.id;
                                this.seleccionResolucionAdjudicaciones.descripcionResAdj =
                                    value.descripcionResAdj;
                            }
                        });

                        let presupuesto =
                            list.Listado[0].Items.Listado[0].Adjudicacion
                                .MontoUnitario;
                        if (
                            presupuesto == null ||
                            presupuesto === 0 ||
                            presupuesto == ""
                        ) {
                            console.log("No hay datos de presupuesto");
                        } else {
                            let tasa = 19;
                            let iva = (presupuesto * tasa) / 100;
                            let total = presupuesto + iva;
                            total = Math.round(total);
                        }
                    })
                    .catch(error => {
                        // Error 😨
                        if (error.response) {
                            /*
                             * The request was made and the server responded with a
                             * status code that falls out of the range of 2xx
                             */
                            console.log(error.response.data);
                            console.log(error.response.status);
                            console.log(error.response.headers);
                        } else if (error.request) {
                            /*
                             * The request was made but no response was received, `error.request`
                             * is an instance of XMLHttpRequest in the browser and an instance
                             * of http.ClientRequest in Node.js
                             */
                            console.log(error.request);
                        } else {
                            // Something happened in setting up the request and triggered an Error
                            console.log("Error", error.message);
                        }
                        console.log(error.config);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        //Fin de Carga Externa
        //Filtros de Datos Existente en BD
        seleccionDescripcionProveedor() {
            try {
                let list = JSON.parse(JSON.stringify(this.listadoProveedores));
                let a = this.seleccionProveedores.rutProveedor;
                list.forEach((value, index) => {
                    if (a == value.rutProveedor) {
                        this.seleccionProveedores.descripcionProveedor =
                            value.descripcionProveedor;
                    }
                });
            } catch (error) {
                console.log(error);
            }
        },
        selecciondescripcionIP() {
            try {
                let list = JSON.parse(
                    JSON.stringify(this.listadoItemPresupuestario)
                );
                let a = this.seleccionItemPresupuestario
                    .codigoItemPresupuestario;
                list.forEach((value, index) => {
                    if (a == value.codigoItemPresupuestario) {
                        this.seleccionItemPresupuestario.descripcionItemPresupuestario =
                            value.descripcionItemPresupuestario;
                    }
                });
            } catch (error) {
                console.log(error);
            }
        },
        //Fin de filtros
        //Guardar Nuevos Datos de Listados en BD
        guardarNuevoSolicitante(desSolicitante) {
            try {
                let objeto = {
                    descripcionSolicitante: desSolicitante
                };
                const data = objeto;
                axios
                    .post(this.localVal + "/api/ART/PostNSolicitante", data, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'Solicitante' a sido guardado con exito, se recargara listado de solicitantes",
                                color: "success",
                                position: "top-right"
                            });
                            this.cargarSolicitantes();
                            this.popCrearSolicitante = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar al nuevo 'Solicitante' Intentelo nuevamente",
                                color: "success",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoEjecutor(desEjecutor) {
            try {
                let objeto = {
                    descripcionEjecutores: desEjecutor
                };
                const data = objeto;
                axios
                    .post(this.localVal + "/api/ART/PostNEjecutor", data, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'Ejecutor' a sido guardado con exito, se recargara listado de Ejecutores",
                                color: "success",
                                position: "top-right"
                            });
                            this.cargarEjecutores();
                            this.seleccionEjecutor.id = 0;
                            this.seleccionEjecutor.descripcionEjecutores = "";
                            this.popCrearEjecutor = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar al nuevo 'Ejecutor' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoItemPresupuestario(codIP, desIP) {
            try {
                let objeto = {
                    codigoItemPresupuestario: codIP,
                    descripcionItemPresupuestario: desIP
                };
                const data = objeto;
                axios
                    .post(
                        this.localVal + "/api/ART/PostNItemPresupuestario",
                        data,
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
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'Item Presupuestario' a sido guardado con exito, se recargara listado de los Items Presupuestarios",
                                color: "success",
                                position: "top-right"
                            });
                            this.cargarItemPresupuestario();
                            this.seleccionItemPresupuestario.id = 0;
                            this.seleccionItemPresupuestario.codigoItemPresupuestario =
                                "";
                            this.seleccionItemPresupuestario.descripcionItemPresupuestario =
                                "";
                            this.codIP;
                            this.desIP;
                            this.popCrearIP = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar al nuevo 'Item Presupuestario' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoTM(desTM) {
            try {
                let objeto = {
                    descripcionTipoMantencion: desTM
                };
                const data = objeto;
                axios
                    .post(
                        this.localVal + "/api/ART/PostNTipoMantencion",
                        data,
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
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'Tipo Mantencion' a sido guardado con exito, se recargara listado de Tipo Mantencion",
                                color: "success",
                                position: "top-right"
                            });
                            this.cargarTipoMantencion();
                            this.seleccionTipoMantencion.id = 0;
                            this.seleccionTipoMantencion.descripcionTipoMantencion =
                                "";
                            this.popCrearTM = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar al nuevo 'Tipo Mantencion' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoR(desR) {
            try {
                let objeto = {
                    descripcionRecursos: desR
                };
                const data = objeto;
                axios
                    .post(this.localVal + "/api/ART/PostNRecursos", data, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'Recurso' a sido guardado con exito, se recargara listado de Recursos",
                                color: "success",
                                position: "top-right"
                            });
                            this.cargarRecursos();
                            this.seleccionRecursos.id = 0;
                            this.seleccionRecursos.descripcionRecursos = "";
                            this.popCrearR = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar al nuevo 'Recurso' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoTC(desTC) {
            try {
                let objeto = {
                    descripcionTipoCompra: desTC
                };
                const data = objeto;
                axios
                    .post(this.localVal + "/api/ART/PostNTipoCompras", data, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'Tipo Compra' a sido guardado con exito, se recargara listado de Tipo Compra",
                                color: "success",
                                position: "top-right"
                            });
                            this.cargarTipoCompra();
                            this.seleccionTipoCompra.id = 0;
                            this.seleccionTipoCompra.descripcionTipoCompra = "";
                            this.popCrearTC = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar al nuevo 'Tipo Compra' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoL(desL) {
            try {
                let objeto = {
                    codigoLicitacion: desL
                };
                const data = objeto;
                axios
                    .post(this.localVal + "/api/ART/PostNLicitacion", data, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'N° Licitacion' a sido guardado con exito, se recargara listado de Licitaciones",
                                color: "success",
                                position: "top-right"
                            });
                            this.cargarLicitaciones();
                            this.seleccionLicitaciones.id = 0;
                            this.seleccionLicitaciones.codigoLicitacion = "";
                            this.popCrearTC = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar 'N° Licitacion' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoRL(desRL) {
            try {
                let objeto = {
                    descripcionResLlamados: desRL
                };
                const data = objeto;
                axios
                    .post(
                        this.localVal + "/api/ART/PostNResolucionLlamado",
                        data,
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
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'N° Resolucion Llamado' a sido guardado con exito, se recargara listado de Resoluciones de Llamados",
                                color: "success",
                                position: "top-right"
                            });
                            this.cargarResolucionLlamado();
                            this.seleccionResolucionLlamado.id = 0;
                            this.seleccionResolucionLlamado.descripcionResLlamados =
                                "";
                            this.popCrearRL = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar 'N° Resolucion Llamado' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoRA(desRA) {
            try {
                let objeto = {
                    descripcionResAdj: desRA
                };
                const data = objeto;
                axios
                    .post(
                        this.localVal +
                            "/api/ART/PostNResolucionAdjudicaciones",
                        data,
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
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'N° Resolucion Adjudicaciones' a sido guardado con exito, se recargara listado de Resolucion Adjudicaciones",
                                color: "success",
                                position: "top-right"
                            });
                            this.cargarResolucionAdjudicaciones();
                            this.seleccionResolucionAdjudicaciones.id = 0;
                            this.seleccionResolucionAdjudicaciones.descripcionResAdj =
                                "";
                            this.popCrearRA = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar 'N° Resolucion Adjudicaciones' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoRC(desRC) {
            try {
                let objeto = {
                    descripcionResContratos: desRC
                };
                const data = objeto;
                axios
                    .post(
                        this.localVal + "/api/ART/PostNResolucionContrato",
                        data,
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
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'N° Resolucion Contrato' a sido guardado con exito, se recargara listado de Resolucion Contrato",
                                color: "success",
                                position: "top-right"
                            });
                            this.cargarResolucionContrato();
                            this.seleccionResolucionContrato.id = 0;
                            this.seleccionResolucionContrato.descripcionResContratos =
                                "";
                            this.popCrearRC = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar 'N° Resolucion Contrato' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoCDP(desCDP) {
            try {
                let objeto = {
                    descripcionCDPS: desCDP
                };
                const data = objeto;
                axios
                    .post(this.localVal + "/api/ART/PostNCDP", data, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'N° CDP' a sido guardado con exito, se recargara listado de CDP",
                                color: "success",
                                position: "top-right"
                            });
                            this.cargarCDP();
                            this.seleccionCDP.id = 0;
                            this.seleccionCDP.descripcionCDPS = "";
                            this.popCrearCDP = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar 'N° CDP' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoOC(desOC) {
            try {
                let objeto = {
                    descripcionOrdenCompras: desOC,
                    fecha_oc: new Date(),
                    idEstadoOC: 1
                };
                const data = objeto;
                axios
                    .post(this.localVal + "/api/ART/PostNOC", data, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'N° Orden Compra' a sido guardado con exito, se recargara listado de Orden Compras",
                                position: "top-right"
                            });
                            this.cargarOrdenCompras();
                            this.seleccionOrdenCompra.id = 0;
                            this.seleccionOrdenCompra.descripcionOrdenCompras =
                                "";
                            this.popCrearOC = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar 'N° Orden Compra' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoRI(desRI) {
            try {
                let objeto = {
                    descripcionResInternas: desRI
                };
                const data = objeto;
                axios
                    .post(this.localVal + "/api/ART/PostNRI", data, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'N° Resolucion Interna' a sido guardado con exito, se recargara listado de Resolucion Interna",
                                position: "top-right"
                            });
                            this.cargarResolucionInterna();
                            this.seleccionResolucionInterna.id = 0;
                            this.seleccionResolucionInterna.descripcionResInternas =
                                "";
                            this.popCrearRI = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar 'N° Resolucion Interna' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarNuevoMemo(desM) {
            try {
                let objeto = {
                    descripcionMemo: desM
                };
                const data = objeto;
                axios
                    .post(this.localVal + "/api/ART/PostNMemo", data, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'N° Memo' a sido guardado con exito, se recargara listado de Memo",
                                position: "top-right"
                            });
                            this.cargarMemos();
                            this.seleccionMemo.id = 0;
                            this.seleccionMemo.descripcionMemo = "";
                            this.popCrearM = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar 'N° Memo' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        guardarProveedor(rutProveedor, desProveedor) {
            try {
                let objeto = {
                    rutProveedor: rutProveedor,
                    descripcionProveedor: desProveedor
                };
                const data = objeto;
                console.log(data);
                axios
                    .post(this.localVal + "/api/ART/PostNProveedor", data, {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        let respuesta = res.data;
                        if (respuesta == true) {
                            this.$vs.notify({
                                time: 3000,
                                title: "Guardado con Exito ",
                                text:
                                    "Nuevo 'Proveedor' a sido guardado con exito, se recargara listado de Proveedor",
                                position: "top-right"
                            });
                            this.cargarProveedores();
                            this.seleccionProveedores.id = 0;
                            this.seleccionProveedores.rutProveedor = "";
                            this.seleccionProveedores.descripcionProveedor = "";
                            this.rutProveedor = "";
                            this.desProveedor = "";
                            this.popCrearProveedor = false;
                        } else {
                            this.$vs.notify({
                                time: 3000,
                                title: "Error",
                                text:
                                    "No fue posible guardar 'Proveedor' Intentelo nuevamente",
                                color: "danger",
                                position: "top-right"
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } catch (error) {
                console.log(error);
            }
        },
        //Fin de Nuevos Datos
        //Carga de Data en Base de Datos a Listados Para v-select
        cargarCDP() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetCDP", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoCDP = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarEjecutores() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetEjecutores", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoEjecutores = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarItemPresupuestario() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetItemPresupuestario", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoItemPresupuestario = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarLicitaciones() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetLicitaciones", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoLicitaciones = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarMemos() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetMemos", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoMemos = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarOrdenCompras() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetOrdenCompras", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoOrdenCompras = res.data;
                        this.listadoOrdenComprasData = JSON.parse(
                            JSON.stringify(this.listadoOrdenCompras)
                        );
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarProveedores() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetProveedores", {
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
        cargarRecursos() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetRecursos", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoRecursos = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarResolucionAdjudicaciones() {
            try {
                axios
                    .get(
                        this.localVal + "/api/ART/GetResolucionAdjudicaciones",
                        {
                            headers: {
                                Authorization:
                                    `Bearer ` + sessionStorage.getItem("token")
                            }
                        }
                    )
                    .then(res => {
                        this.listadoResolucionAdjudicaciones = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarResolucionContrato() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetResolucionContratos", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoResolucionContrato = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarResolucionInterna() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetResolucionInternas", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoResolucionInterna = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarResolucionLlamado() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetResolucionLlamados", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoResolucionLlamados = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarSolicitantes() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetSolicitantes", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoSolicitantes = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarTipoCompra() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetTipoCompras", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoTipoCompra = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        },
        cargarTipoMantencion() {
            try {
                axios
                    .get(this.localVal + "/api/ART/GetTipoMantenciones", {
                        headers: {
                            Authorization:
                                `Bearer ` + sessionStorage.getItem("token")
                        }
                    })
                    .then(res => {
                        this.listadoTipoMantencion = res.data;
                    });
            } catch (error) {
                console.log(error);
            }
        }
        //Fin de Carga de data
    },
    created: function() {
        this.cargarCDP();
        this.cargarEjecutores();
        this.cargarItemPresupuestario();
        this.cargarLicitaciones();
        this.cargarMemos();
        this.cargarOrdenCompras();
        this.cargarProveedores();
        this.cargarRecursos();
        this.cargarResolucionAdjudicaciones();
        this.cargarResolucionContrato();
        this.cargarResolucionInterna();
        this.cargarResolucionLlamado();
        this.cargarSolicitantes();
        this.cargarTipoCompra();
        this.cargarTipoMantencion();
        this.convertirMonto();
        this.convertirSaldo();
    }
};
</script>
<style>
.con-vs-popup .vs-popup {
    width: auto !important;
}
</style>
