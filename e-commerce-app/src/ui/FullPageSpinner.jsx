function FullPageSpinner() {
  return (
    <div className="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40">
      <div className="absolute h-20 w-20 animate-spin rounded-full border-b-4 border-t-4 border-purple-500"></div>
    </div>
  );
}

export default FullPageSpinner;
