import { BrowserRouter, Route, Routes } from "react-router-dom";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import { ReactQueryDevtools } from "@tanstack/react-query-devtools";
import { Toaster } from "react-hot-toast";
import AppLayout from "./ui/AppLayout";
import Home from "./pages/Home";
import Shop from "./pages/Shop";
import ProductDetail from "./feature/product/ProductDetail";
import Login from "./pages/Login";
import Register from "./pages/Register";
import Account from "./pages/Account";
import ContextProvider from "./context/ContextProvider";
import { Provider } from "react-redux";
import store from "./store";

function App() {
  const queryClient = new QueryClient({
    defaultOptions: {
      queries: {
        staleTime: 0,
      },
    },
  });

  return (
    <QueryClientProvider client={queryClient}>
      <Provider store={store}>
        <ContextProvider>
          <ReactQueryDevtools />
          <BrowserRouter>
            <Routes>
              <Route element={<AppLayout />}>
                <Route path="/" element={<Home />} />
                <Route path="shop" element={<Shop />} />
                <Route path="shop/:productSlug" element={<ProductDetail />} />
                <Route path="aboutus" element={<Shop />} />
                <Route path="contact" element={<Shop />} />
                <Route path="login" element={<Login />} />
                <Route path="register" element={<Register />} />
                <Route path="account" element={<Account />} />
              </Route>
            </Routes>
            <Toaster
              position="top-center"
              toastOptions={{
                success: {
                  duration: 3000,
                },
                error: {
                  duration: 5000,
                },
              }}
            />
          </BrowserRouter>
        </ContextProvider>
      </Provider>
    </QueryClientProvider>
  );
}

export default App;
