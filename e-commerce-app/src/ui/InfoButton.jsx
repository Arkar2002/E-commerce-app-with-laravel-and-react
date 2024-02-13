import { HiOutlineInformationCircle } from "react-icons/hi2";
import IconButton from "./IconButton";

function InfoButton({ to }) {
  return (
    <IconButton to={to}>
      <HiOutlineInformationCircle />
    </IconButton>
  );
}

export default InfoButton;
