import { Outlet, useLocation } from "react-router-dom";
import Header from "./Header";
import Footer from "./Footer";
import { useEffect } from "react";

function AppLayout() {
  const { pathname } = useLocation();

  useEffect(() => {
    window.onbeforeunload = function () {
      window.scrollTo(0, 0);
    };
    window.scroll = window.scrollTo(0, 0);
  }, [pathname]);

  return (
    <>
      <Header />
      <main className="min-h-24">
        <Outlet />
      </main>
      <Footer />
    </>
  );
}

export default AppLayout;
