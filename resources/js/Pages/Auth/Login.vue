<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, onMounted } from "vue";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import ButtonAdd from "@/Components/ButtonAdd.vue";
import $ from "jquery";

onMounted(() => {
    
    $(".info-item .btn").click(function () {
        $(".container").toggleClass("log-in");
    });
    /*
    $(".container-form .btn").click(function () {
        $(".container").addClass("active");
    });
    */
});

defineProps({
    canResetPassword: Boolean,
    status: String,
});

/*Login form styles*/
const form = useForm({
    email: "",
    password: "",
    remember: false,
    status: String,
});

const style1 = ref(false);

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

/*Form reset password*/

const style2 = ref(false);

const formReset = useForm({
    email: "",
});

const submitReset = () => {
    formReset.post(route("password.email"));
};
</script>

<template>
    <Head title="Log in" />
    <div class="h-screen login">
        <div
            class="flex items-center justify-between col-span-3 col-start-1 row-start-1 p-8 mb-2 text-white sm:hidden"
            style="text-align: left"
        >
            <div class="pl-4">
                <span
                    class="w-1 h-20 bg-[#EC2944] mt-1"
                    style="position: absolute; width: 0.1rem"
                ></span>
                <h1 class="ml-2 text-xl" style="font-family: 'Montserrat'">
                    Bienvenido a<br />
                    <span class="font-extrabold uppercase"
                        >Intranet<br />
                        Coorsa</span
                    >
                </h1>
            </div>
            <div class="pr-4">
                <img src="../../../img/Icono-coorsa.svg" alt="" />
            </div>
        </div>

        <!-- Fin Mobile -->
        <div
            class="border-hidden border-white sm:border-2 sm:border-solid sm:col-start-2 col-span-3 row-start-2 col-start-1 flex sm:w-[50rem] rounded-[2rem] sm:h-80 h-40 row-span-2 justify-center"
        >
            <div class="container flex flex-col sm:flex-row">
                <div class="box"></div>
                <div class="container-forms">
                    <div class="container-info sm:hidden">
                        <div class="info-item sign-up">
                            <div class="table">
                                <div class="table-cell">
                                    <p
                                        class="text-white"
                                        style="
                                            font-family: 'Montserrat';
                                            font-size: 1rem;
                                        "
                                    >
                                        ¿Ya tienes una cuenta?
                                    </p>
                                    <div
                                        class="btn"
                                        style="
                                            display: flex;
                                            justify-content: center;
                                            font-size: 1rem;
                                            width: 0rem;
                                        "
                                    >
                                        Iniciar sesión
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-item s log-in">
                            <div class="table ml-10 sm:ml-8">
                                <div class="table-cell">
                                    <p
                                        style="
                                            color: white;
                                            margin: 0;
                                            font-size: 1rem;
                                        "
                                    >
                                        ¿Olvidaste tu contraseña?
                                    </p>
                                    <div
                                        class="btn"
                                        style="
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            margin-top: 1rem;
                                        "
                                    >
                                        <p style="font-size: 0.8rem">
                                            Reestablecer
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden container-info sm:block">
                        <div class="info-item">
                            <div class="table">
                                <div class="table-cell">
                                    <p
                                        class="text-white"
                                        style="
                                            font-family: 'Montserrat';
                                            font-size: 1rem;
                                        "
                                    >
                                        ¿Ya tienes una cuenta?
                                    </p>
                                    <div
                                        class="btn"
                                        style="
                                            display: flex;
                                            justify-content: center;
                                            font-size: 1rem;
                                            width: 0rem;
                                        "
                                    >
                                        Iniciar sesión
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-item log-in">
                            <div class="table">
                                <div class="table-cell">
                                    <p
                                        class="hidden sm:block"
                                        style="
                                            color: white;
                                            margin: 0;
                                            font-size: 1rem;
                                          
                                        "
                                    >
                                        ¿Olvidaste tu <br />contraseña?
                                    </p>
                                    <p
                                        class="sm:hidden"
                                        style="
                                            color: white;
                                            margin: 0;
                                            font-size: 1rem;
                                          
                                        "
                                    >
                                        ¿Olvidaste tu contraseña?
                                    </p>
                                    <div
                                        class="btn"
                                        style="
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            margin-top: 1rem;
                                        "
                                    >
                                        <p style="font-size: 0.8rem">
                                            Reestablecer
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-form">
                        <div class="form-item log-in">
                            <div class="table">
                                <div class="table-cell">
                                    <div
                                        class="hidden mt-4 sm:flex"
                                        style="
                                            text-align: justify;
                                            margin-left: 2rem;
                                        "
                                    >
                                        <span
                                            class="w-1 h-12 bg-[#EC2944] mt-1"
                                            style="position: absolute"
                                        ></span>
                                        <h1
                                            class="ml-2 text-xl"
                                            style="font-family: 'Montserrat'"
                                        >
                                            Bienvenido a<br />
                                            <span
                                                class="font-extrabold uppercase"
                                            >
                                                Intranet Coorsa
                                            </span>
                                        </h1>
                                    </div>
                                    <div
                                        class="mt-4 sm:hidden"
                                        style="
                                            text-align: justify;
                                            margin-left: 2rem;
                                        "
                                    >
                                        <h1
                                            class="ml-2 text-xl"
                                            style="font-family: 'Montserrat'"
                                        >
                                            Iniciar<br />
                                            <span
                                                class="font-extrabold uppercase"
                                                >Sesión</span
                                            >
                                        </h1>
                                    </div>
                                    <div class="m-8">
                                        <form>
                                            
                                            <div class="mt-10">
                                                <TextInput
                                                    id="email"
                                                    v-model="form.email"
                                                    type="email"
                                                    class="block w-full mt-1 text-gray-500 opacity-80"
                                                    required
                                                    autofocus
                                                    placeholder="Usuario"
                                                    style="
                                                        border-radius: 5rem;
                                                        font-family: 'Montserrat';
                                                    "
                                                />
                                                <InputError
                                                    class=""
                                                    :message="form.errors.email"
                                                />
                                            </div>
                                            <div class="mt-10">
                                                <TextInput
                                                    id="password"
                                                    v-model="form.password"
                                                    type="password"
                                                    class="block w-full mt-1 text-gray-500 opacity-80"
                                                    required
                                                    autocomplete="current-password"
                                                    placeholder="Contraseña"
                                                    style="border-radius: 5rem"
                                                />
                                                <InputError
                                                    class="mt-2"
                                                    :message="
                                                        form.errors.password
                                                    "
                                                />
                                            </div>
                                            <div class="" style="display: flex">
                                                <label
                                                    class="flex items-center"
                                                >
                                                    <Checkbox
                                                        style="
                                                            padding: 0;
                                                            margin-top: 0.5rem;
                                                        "
                                                        v-model:checked="
                                                            form.remember
                                                        "
                                                        name="remember"
                                                    />
                                                    <span class="ml-2 text-sm"
                                                        >Recordar</span
                                                    >
                                                </label>
                                            </div>
                                            <div
                                                class="btn"
                                                style="
                                                    margin-top: 0rem;
                                                    display: flex;
                                                    justify-content: center;
                                                    margin-right: 0rem;
                                                "
                                            >
                                                <button
                                                    @click="submit"
                                                    :class="{
                                                        'opacity-25':
                                                            form.processing,
                                                    }"
                                                    :disabled="form.processing"
                                                    style="font-size: 0.8rem"
                                                >
                                                    Iniciar sesión
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-item sign-up">
                            <div class="table">
                                <div class="table-cell">
                                    <div
                                        class=""
                                        style="
                                            text-align: justify;
                                            margin-left: 2rem;
                                            margin-top: -4rem;
                                        "
                                    >
                                        <span
                                            class="w-1 h-12 bg-[#EC2944]"
                                            style="position: absolute"
                                        ></span>
                                        <h1 class="ml-2 text-xl">
                                            Restablece<br />
                                            <span
                                                class="font-extrabold uppercase"
                                                style="
                                                    font-family: 'Montserrat';
                                                "
                                                >Tu contraseña.</span
                                            >
                                        </h1>
                                    </div>
                                    <div class="ml-2 mr-2">
                                      <div class="static mt-8 ml-2 sm:hidden">
                                        <span class="bg-[#EC2944] absolute w-2 h-12"></span>
                                        <h1 class="ml-4 text-xl">Reestablece<br>
                                            <span class="font-bold uppercase">Tu contraseña</span>
                                        </h1>
                                      </div>
                                        <form>
                                            <div class="mt-10 ml-6">
                                                <TextInput
                                                    id="email"
                                                    v-model="formReset.email"
                                                    type="email"
                                                    class="block w-full mt-1 text-gray-500 opacity-80"
                                                    required
                                                    autofocus
                                                    placeholder="Usuario"
                                                    style="
                                                        border-radius: 5rem;
                                                        font-family: 'Montserrat';
                                                    "
                                                />
                                                <InputError
                                                    class=""
                                                    :message="
                                                        formReset.errors.email
                                                    "
                                                />
                                            </div>
                                            <div
                                                class="btn"
                                                style="
                                                    display: flex;
                                                    justify-content: center;
                                                    margin-right: 2rem;
                                                "
                                            >
                                                <button
                                                    @click="submitReset"
                                                    :class="{
                                                        'opacity-25':
                                                            form.processing,
                                                    }"
                                                    :disabled="form.processing"
                                                >
                                                
                                                    Enviar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="col-span-3 col-start-1 sm:col-start-2 sm:row-start-4"
        style="
            margin-top: -5rem;
            display: flex;
            justify-content: center;
            font-family: 'Montserrat';
        "
    >
        <h2 class="text-white">
            <a class="text-xs sm:xl text_link" href="https://coorsamexico.com/">WWW.COORSAMEXICO.COM</a>
        </h2>
    </div>
</template>
