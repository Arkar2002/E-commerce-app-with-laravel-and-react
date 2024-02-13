import { FaArrowLeft } from "react-icons/fa";
import { useMoveBack } from "../hooks/useMoveBack";

function BackButton() {
  const moveBack = useMoveBack();

  return (
    <button
      className="flex items-center gap-1 rounded bg-gray-700 p-1 text-white"
      onClick={moveBack}
    >
      <span className="text-xs">
        <FaArrowLeft />
      </span>{" "}
      Back
    </button>
  );
}

export default BackButton;
