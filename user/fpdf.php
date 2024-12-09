<?php
session_start(); 
require('../fpdf/fpdf.php'); // Include the FPDF library

// Check if checkout data is set
if (!isset($_SESSION['checkout_data'])) {
    header("Location: checkout.php");
    exit();
}

$checkoutData = $_SESSION['checkout_data'];
$cart = $_SESSION['Cart'] ?? [
    ['productname' => 'Sample Item 1', 'productprice' => 20, 'productquantity' => 2],
    ['productname' => 'Sample Item 2', 'productprice' => 15, 'productquantity' => 1],
];
$totalAmount = 0;

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Title
$pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');

// Customer Details
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(5);
$pdf->Cell(0, 10, 'Customer Details:', 0, 1);
$pdf->Cell(0, 10, 'Name: ' . $checkoutData['name'], 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $checkoutData['email'], 0, 1);
$pdf->Cell(0, 10, 'Address: ' . $checkoutData['address'], 0, 1);
$pdf->Cell(0, 10, 'Phone: ' . $checkoutData['phone'], 0, 1);

// Order Summary
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, '#', 1);
$pdf->Cell(80, 10, 'Product Name', 1);
$pdf->Cell(30, 10, 'Price', 1);
$pdf->Cell(20, 10, 'Qty', 1);
$pdf->Cell(30, 10, 'Total', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);
foreach ($cart as $index => $item) {
    $productTotal = (float)$item['productprice'] * (int)$item['productquantity'];
    $totalAmount += $productTotal;

    $pdf->Cell(10, 10, $index + 1, 1);
    $pdf->Cell(80, 10, $item['productname'], 1);
    $pdf->Cell(30, 10, '$' . number_format($item['productprice'], 2), 1);
    $pdf->Cell(20, 10, $item['productquantity'], 1);
    $pdf->Cell(30, 10, '$' . number_format($productTotal, 2), 1);
    $pdf->Ln();
}

// Total Amount
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(140, 10, 'Grand Total', 1);
$pdf->Cell(30, 10, '$' . number_format($totalAmount, 2), 1);

// Thank You Message
$pdf->Ln(20);
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 10, 'Thank you for your order!', 0, 1, 'C');

// Output PDF
$pdf->Output('D', 'invoice.pdf'); // Force download with file name 'invoice.pdf'
