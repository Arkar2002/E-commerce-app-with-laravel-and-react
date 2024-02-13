import axios from "axios";
import toast from "react-hot-toast";

export const axiosClient = axios.create({
  baseURL: `${import.meta.env.VITE_BACK_END_URL}/api/`,
});

axiosClient.interceptors.request.use((config) => {
  const token = JSON.parse(localStorage.getItem("ACCESS_TOKEN"));
  config.headers.Authorization = `Bearer ${token}`;
  return config;
});

axiosClient.interceptors.response.use(
  (response) => response,
  ({ response }) => {
    console.log(response);
    if (response.status === 422) {
      toast.error(response.data.message);
    } else if (response.status === 401) {
      localStorage.setItem("ACCESS_TOKEN", null);
    } else {
      toast.error("Something went wrong");
    }
  },
);
