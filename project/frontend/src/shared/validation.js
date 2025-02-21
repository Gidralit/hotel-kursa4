import * as yup from "yup";

export const registrationSchema = yup.object({
    name: yup
        .string()
        .matches(/^[а-яА-ЯёЁa-zA-Z\s.-]+$/, "Имя может содержать только буквы, пробелы, точки и тире")
        .required("Поле является обязательным"),
    email: yup
        .string()
        .email("Некорректная почта")
        .required("Поле является обязательным"),
    phone: yup
        .string()
        .matches(/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/, "Телефон должен быть в формате +7(ХХХ)ХХХ-ХХ-ХХ")
        .required("Поле является обязательным"),
    password: yup
        .string()
        .min(8, "Минимум 8 символов")
        .matches(/[A-Za-z\d@$!%*?&]/, "Пароль должен содержать буквы, цифры или спецсимволы")
        .required("Поле является обязательным"),
    photo: yup
        .mixed()
        .test("fileSize", "Файл не должен превышать 2MB", (file) => {
            return !file || (file && file.size <= 2097152);
        })
        .test("fileType", "Файл должен быть формата jpeg или png", (file) => {
            return !file || (file && ["image/jpeg", "image/png"].includes(file.type));
        }),
});