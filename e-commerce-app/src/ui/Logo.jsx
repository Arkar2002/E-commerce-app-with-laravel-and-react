import { Link } from "react-router-dom";

function Logo() {
  return (
    <Link to="/">
      <img src="/images/logo.svg" className="w-32" alt="logo" />
    </Link>
  );
}

export default Logo;
