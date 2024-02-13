import { NavLink } from "react-router-dom";

function Nav() {
  return (
    <div className="flex space-x-4 text-gray-400">
      <NavLink to="/" className="group transition hover:text-gray-100">
        <span className="group-[.active]:text-gray-100">Home</span>
      </NavLink>
      <NavLink to="/shop" className="group transition hover:text-gray-100">
        <span className="group-[.active]:text-gray-100">Shop</span>
      </NavLink>
      <NavLink to="/aboutus" className="group transition hover:text-gray-100">
        <span className="group-[.active]:text-gray-100">About us</span>
      </NavLink>
      <NavLink to="/contact" className="group transition hover:text-gray-100">
        <span className="group-[.active]:text-gray-100">Contact us</span>
      </NavLink>
    </div>
  );
}

export default Nav;
