import { useEffect } from "react";
import { useContextProvider } from "../context/ContextProvider";
import { useUser } from "../feature/user/useUser";
import Categories from "./Categories";
import HeaderIcons from "./HeaderIcons";
import LoginBtn from "./LoginBtn";
import Logo from "./Logo";
import Nav from "./Nav";
import Search from "./Search";

function Header() {
  const { user, hasUser } = useContextProvider();
  return (
    <>
      <header className="bg-white py-4 shadow-md dark:bg-slate-800">
        <div className="container flex items-center justify-between">
          <Logo />
          <Search />
          {hasUser && <HeaderIcons user={user} />}
        </div>
      </header>
      <nav className="bg-gray-800">
        <div className="container flex">
          <Categories />
          <div className="flex grow items-center justify-between px-8">
            <Nav />
            {!hasUser && <LoginBtn />}
          </div>
        </div>
      </nav>
    </>
  );
}

export default Header;
