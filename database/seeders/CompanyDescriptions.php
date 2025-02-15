<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
class CompanyDescriptions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();
        foreach($companies as $company) {
            $description = [
                "ar" => $company->getTranslation("name", "en") . " based on Dubai offers an extensive fleet of vehicles tailored to meet every need. Our diverse range includes economy, luxury, SUVs, and vans, ensuring there's a perfect fit for every traveler. We proudly feature top brands like Toyota, BMW, and Mercedes, known for their reliability and performance. Our reputation is built on exceptional customer service, competitive pricing, and well-maintained cars. Explore our latest offers for unbeatable deals on your next rental. Experience the convenience and comfort of driving in Dubai with Rentry!",
                "en" => $company->getTranslation("name", "en") . " based on Dubai offers an extensive fleet of vehicles tailored to meet every need. Our diverse range includes economy, luxury, SUVs, and vans, ensuring there's a perfect fit for every traveler. We proudly feature top brands like Toyota, BMW, and Mercedes, known for their reliability and performance. Our reputation is built on exceptional customer service, competitive pricing, and well-maintained cars. Explore our latest offers for unbeatable deals on your next rental. Experience the convenience and comfort of driving in Dubai with Rentry!"
            ];
            $terms = [
                "ar" => "
                    <ul>
                        <li>Minimum age is typically 21 years.</li>
                        <li>For adding extra driver 150 AED</li>
                        <li>Fuel policy level to level </li>
                        <li>cleaning policy the car should return clean otherwise 100 AED fine applicable</li>
                    </ul>
                ",
                "en" => "
                    <ul>
                        <li>Minimum age is typically 21 years.</li>
                        <li>For adding extra driver 150 AED</li>
                        <li>Fuel policy level to level </li>
                        <li>cleaning policy the car should return clean otherwise 100 AED fine applicable</li>
                    </ul>
                "
            ];
            $company->update([
                "description" => $description,
                "terms" => $terms
            ]);
        }
    }
}
